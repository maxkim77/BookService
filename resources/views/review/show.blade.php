@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <img src="{{ $review['book']['extraLarge'] }}" alt="{{ $review['book']['title'] }}" class="img-thumbnail" style="max-height: 600px;">
        </div>
        <div class="col-md-8">
            <p><strong>Authors:</strong> {{ $review['book']['authors'] ?? '정보 없음' }}</p>
            <p><strong>Categories:</strong> {{ $review['book']['category'] ?? '정보 없음' }}</p>
            <p><strong>Publisher:</strong> {{ $review['book']['publisher'] ?? '정보 없음' }}</p>
            <p><strong>Published Date:</strong> {{ $review['book']['publishedDate'] ?? '정보 없음' }}</p>
            <p><strong>Review Title:</strong> {{ $review['review_title'] ?? '정보없음' }}</p>
            <p><strong>Review Category:</strong> {{ $review['review_category'] ?? '정보없음' }}</p>
            <p><strong>Review:</strong> {{ $review['review'] ?? '정보없음' }}</p>

            @php
                $userLiked = false;
                if (auth()->check()) {
                    $userLiked = collect($review['likes'])->contains(function ($like) {
                        return $like['user_id'] == auth()->user()->id;
                    });
                }
            @endphp

            <div class="mb-3">
                @if ($userLiked)
                    <form action="{{ route('likes.destroy', $review['id']) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            ❤ 좋아요 취소
                        </button>
                    </form>
                @else
                    <form action="{{ route('likes.store') }}" method="POST" style="display:inline-block;">
                        @csrf
                        <input type="hidden" name="review_id" value="{{ $review['id'] }}">
                        <button type="submit" class="btn btn-danger">
                            <i class="fa fa-heart"></i> 좋아요
                        </button>
                    </form>
                @endif
            </div>

            <a href="{{ route('company.library') }}" class="btn btn-success">Home</a>
            <a href="{{ route('review.edit', $review['id']) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('review.destroy', $review['id']) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection
