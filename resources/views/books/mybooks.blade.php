@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>마이 리뷰 리스트</h3>
            <br>
    

            <div class="row mt-3">
                @foreach ($myBooks as $book)
                    <div class="col-md-2 mb-4">
                        <div class="book-card">
                            <img src="{{ $book['book']['thumbnail'] }}" alt="{{ $book['book']['title'] }}" class="img-fluid" style="max-height: 100px;">
                            <div class="book-details">
                                <h5 class="book-title">{{ $book['review_title'] }}</h5>
                                <p class="book-authors">{{ $book['book']['author'] }}</p>
                                <a href="/review/{{ $book['id'] }}" class="btn btn-success">자세히</a>
                            </div>
                        </div>
                    </div>
                    @if ($loop->iteration % 6 == 0)
                        <div class="w-100"></div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
