<div class="modal-header">
    <h4 class="modal-title" id="reviewModalLabel">글쓰기</h4>
    <button type="button" class="btn-close" id="closeReviewModalButton" aria-label="Close">닫기</button>
</div>
<div class="modal-body" style="max-height: 80vh; overflow-y: auto;">
    <div id="searchContainer">
        @include('reviews.search')
    </div>
    <div id="selectedBook" class="mt-3" style="display: none;">
        <h5>Selected Book:</h5>
        <img id="selectedBookThumbnail" class="img-thumbnail" style="max-height: 100px;">
        <h5 id="selectedBookTitle"></h5>
        <h5 id="selectedBookAuthors"></h5>
        <h5 id="selectedBookCategories"></h5>
    </div>
    <form id="reviewForm" method="POST" action="{{ route('review.store') }}">
        @csrf
        <input type="hidden" name="book_id" id="book_id">
        <input type="hidden" name="large" id="thumbnail">
        <input type="hidden" name="authors" id="authors">
        <input type="hidden" name="categories" id="categories">
        <input type="hidden" name="share" value="my_library">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" required readonly>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" readonly></textarea>
        </div>
        <div class="form-group">
            <label for="author">Author</label>
            <input type="text" class="form-control" id="author" name="author" readonly>
        </div>
        <div class="form-group">
            <label for="categories">Categories</label>
            <input type="text" class="form-control" id="categories" name="categories" readonly>
        </div>
        <div class="form-group">
            <label for="review">Review Title</label>
            <input class="form-control" id="review_title" name="review_title" required />
        </div>
        <div class="form-group">
            <label for="review">Review Category</label>
            <input class="form-control" id="review_category" name="review_category" required />
        </div>
        
        <div class="form-group">
            <label for="review">Review</label>
            <textarea class="form-control" id="review" name="review" required></textarea>
        </div>
        <div class="form-group">
    <label>공유 대상</label>
    <div>
        <input type="checkbox" id="sharedWithMyLibrary" name="share[]" value="my_library" checked disabled>
        <label for="sharedWithMyLibrary">내 서재</label>
    </div>
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="sharedWithCompanyLibrary" name="share[]" value="company_library">
        <label class="form-check-label" for="sharedWithCompanyLibrary">회사 서재</label>
    </div>
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="sharedWithSocialLibrary" name="share[]" value="social_library">
        <label class="form-check-label" for="sharedWithSocialLibrary">소셜 서재</label>
    </div>
</div>

        <button type="submit" class="btn btn-primary">저장</button>
    </form>
</div>
