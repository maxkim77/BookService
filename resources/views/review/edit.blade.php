@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1>Edit Review</h1>

            <form method="POST" action="{{ route('review.update', $review->id) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="review_title">Title</label>
                    <input type="text" class="form-control" id="review_title" name="review_title" value="{{ $review->review_title }}" required>
                </div>
                <div class="form-group">
                    <label for="review_category">Category</label>
                    <input type="text" class="form-control" id="review_category" name="review_category" value="{{ $review->review_category }}">
                </div>
                <div class="form-group">
                    <label for="review">Review</label>
                    <textarea class="form-control" id="review" name="review">{{ $review->review }}</textarea>
                </div>
                <div class="form-group">
                    <label>Share with</label>
                    <div>
                        <input type="checkbox" id="sharedWithMyLibrary" name="share[]" value="my_library" {{ $review->shares->contains('share', 'my_library') ? 'checked' : '' }}>
                        <label for="sharedWithMyLibrary">My Library</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="sharedWithCompanyLibrary" name="share[]" value="company_library" {{ $review->shares->contains('share', 'company_library') ? 'checked' : '' }}>
                        <label class="form-check-label" for="sharedWithCompanyLibrary">Company Library</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="sharedWithSocialLibrary" name="share[]" value="social_library" {{ $review->shares->contains('share', 'social_library') ? 'checked' : '' }}>
                        <label class="form-check-label" for="sharedWithSocialLibrary">Social Library</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection
