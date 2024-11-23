<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Services\GoogleBooksService;

class BookController extends Controller
{
    private $googleBooksService;

    public function __construct(GoogleBooksService $googleBooksService)
    {
        $this->googleBooksService = $googleBooksService;
    }
    

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Implement the logic for showing the form to create a new resource.
    }

    /**
     * Display the specified resource.
     * 특정 책에 대한 관련된 리뷰 정보들을 보여주게 끔 하는 메서드 입니다.
     */
    public function show(string $id): View
    {        
        $bookResponse = $this->googleBooksService->getBook($id);
        $reviews = Review::where('book_id', $id)->get()->toArray();
        return view('books.show', compact('bookResponse', 'reviews'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        // Implement the logic for showing the form to edit a resource.
    }

    /**
     * Update the specified resource in storage.
     */
    public function update()
    {
        // Implement the logic for updating the specified resource.
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        // Implement the logic for removing the specified resource.
    }
}
