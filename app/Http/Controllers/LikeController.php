<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Like;
class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $request->validate([
            'review_id' => 'required|exists:reviews,id',
        ]);

        $review = Review::findOrFail($request->input('review_id'));
        $user = auth()->user();

        if (!$review->likes()->where('user_id', $user->id)->exists()) {
            // 좋아요 추가
            $like = new Like([
                'user_id' => $user->id,
                'review_id' => $review->id,
            ]);
            $review->likes()->save($like);
        }

        return redirect()->back()->with('status', '좋아요가 추가되었습니다.');
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
        $review = Review::findOrFail($id);
        $user = auth()->user();

        $review->likes()->where('user_id', $user->id)->delete();

        return redirect()->back()->with('status', '좋아요가 취소되었습니다.');    
    }
}
