<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class CompanyLibraryController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $sort = $request->input('sort', 'recent');
    
        // with 먼저 넣기 미리 로드 하는 방식
        $query = Review::with(['book', 'user', 'shares'])
            ->whereHas('shares', function ($query) {
                $query->where('share', 'company_library');
            })
            ->whereHas('user', function ($query) use ($user) {
                $query->where('company', $user->company);
            });

        switch ($sort) {
            case 'oldest':
                $query->orderBy('id', 'asc');
                break;
            case 'likes':
                $query->withCount('likes')
                      ->orderBy('likes_count', 'desc');
                break;
            case 'recent':
            default:
                $query->orderBy('id', 'desc');
                break;
        }
    
        $companyBooks = $query->get()->toArray();
        return view('books.companybooks', compact('companyBooks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
