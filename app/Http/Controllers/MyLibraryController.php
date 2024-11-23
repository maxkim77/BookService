<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Review;

class MyLibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     * 공유옵션(sahred_with)이 내서재인(my_library) 리뷰들을 조회합니다. 
     */
    public function index(): View
    {
        $myBooks = Review::with('book','user','shares')
            ->where('user_id', auth()->id())
            ->whereHas('shares', function ($query) {
                $query->where('share','my_library');
            })
            ->get()->toArray();
        return view('books.mybooks', compact('myBooks'));
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
