<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Book;
use App\Models\Share;
use App\Services\GoogleBooksService;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    private $googleBooksService;

    public function __construct(GoogleBooksService $googleBooksService)
    {
        $this->googleBooksService = $googleBooksService;
    }

    public function index()
    {
        // Implement the logic for listing resources if necessary.
    }

    public function create()
    {
        // Implement the logic for showing the form to create a new resource.
    }

    public function show(int $review_id)
    {   
        $review = Review::with('book','likes','shares')->findOrFail($review_id);
        $review->toArray();

        return view('review.show', ['review'=> $review]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_id' => 'required|string|max:255',
            'review_title' => 'required|string|max:255',
            'review_category' => 'nullable|string|max:255',
            'review' => 'nullable|string',
            'share' => 'array', 
            'share.*' => 'in:company_library,social_library',
        ]);
        
        $bookId = $validated['book_id'];
        $bookData = $this->googleBooksService->getBook($bookId);
    
        // bookData가 없으면 에러 처리

    
        $filteredBook = [
            'id' => $bookData['id'],
            'title' => $bookData['title'],
            'author' => $bookData['authors'][0] ?? 'Unknown',
            'description' => $bookData['description'] ?? null,
            'thumbnail' => $bookData['thumbnail'] ?? null,
            'extraLarge' => $bookData['extraLarge'] ?? null,
            'category' => isset($bookData['categories']) ? implode(', ', $bookData['categories']) : null,
            'publisher' => $bookData['publisher'] ?? 'Unknown',
            'publishedDate' => $bookData['publishedDate'] ?? null,
            'price' => $bookData['price']->amount ?? null,
            'buyLink' => $bookData['buyLink'] ?? null,
        ];
    
        $filteredReview = [
            'user_id' => auth()->user()->id,
            'book_id' => $bookData['id'],
            'review_title' => $validated['review_title'],
            'review_category' => $validated['review_category'],
            'review' => $validated['review'],
        ];
    
        Book::create($filteredBook);
        $storedReview = Review::create($filteredReview);
        $selectedShares = array_unique(array_merge(['my_library'], $validated['share']));
    
        $insertData = [];
        foreach ($selectedShares as $selectedShare)
        {   
            $data = [
                'review_id' => $storedReview->id, // 추가: review_id 필드 값 설정
                'share' => $selectedShare,
            ];
            array_push($insertData, $data);
        }
    
        Share::insert($insertData);
        return redirect()->route('review.show', ['review_id' => $storedReview->id]);
    }
    
    

    public function edit(int $review_id)
    {
        $review = Review::findOrFail($review_id);
        return view('review.edit', compact('review'));
    }

    public function update(Request $request, int $review_id)
    {
        $validated = $request->validate([
            'review_title' => 'required|string|max:255',
            'review_category' => 'nullable|string|max:255',
            'review' => 'nullable|string',
            'share' => 'required|array',
            'share.*' => 'in:my_library,company_library,social_library',
        ]);
        $userId = auth()->user()->id;

        Review::where([
            ['id', $review_id],
            ['user_id', $userId]
        ])->firstOrFail();
        
        Review::where('id', $review_id)->update([
            'review_title' => $validated['review_title'],
            'review_category' => $validated['review_category'],
            'review' => $validated['review'],
        ]);
    
        $selectedShares = array_unique(array_merge(['my_library'], $validated['share']));

        $insertData =[];
        foreach ($selectedShares as $selectedShare)
        {   
            $data = [
                'review_id' => $review_id,
                'share' => $selectedShare,
            ];
            array_push($insertData, $data);
        }

        Share::where('review_id', $review_id)->delete();
        Share::insert($insertData);
        return redirect()->route('review.show', ['review_id' => $review_id]);
    }
    

    public function destroy($review_id)
    {
        $userId = auth()->user()->id;

        // 리뷰 작성자인지 확인
        $review = Review::where([
            ['id', $review_id],
            ['user_id', $userId]
        ])->firstOrFail();

        Share::where('review_id', $review_id)->delete();
        $review->delete();
        return redirect()->route('my.library');
    }
}
