@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <div class="position-relative" style="max-width: 600px;">
                <i class="fas fa-search position-absolute" style="left: 15px; top: 50%; transform: translateY(-50%); color: #4CAF50;"></i>
                <input type="text" id="keyword" class="form-control search-input" placeholder=" 책이름을 검색해주세요." style="border-radius: 30px; padding-left: 40px;">
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <h3>마상소프트 베스트 리뷰</h3>
            <p>최근 한달간 도서리뷰가 많이 작성된 순서입니다.</p>
            <div id="bestReviews" class="d-flex justify-content-start overflow-auto">
                <!-- 베스트 리뷰 동적 콘텐츠 여기에 삽입 -->
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <h3>도서 리뷰 리스트</h3>
            <p>사내 직원들이 등록한 도서 리뷰입니다.</p>
            <div style="margin-top: 30px;"></div>
            <a href="{{ route('company.library', ['sort' => 'recent']) }}" class="btn {{ request('sort') == 'recent' ? 'btn-success text-white' : 'btn-outline-secondary' }}">최근 등록순</a>
            <a href="{{ route('company.library', ['sort' => 'oldest']) }}" class="btn {{ request('sort') == 'oldest' ? 'btn-success text-white' : 'btn-outline-secondary' }}">오래된 순</a>
            <a href="{{ route('company.library', ['sort' => 'likes']) }}" class="btn {{ request('sort') == 'likes' ? 'btn-success text-white' : 'btn-outline-secondary' }}">추천 리뷰순</a>
        </div>
    </div>
    <div style="margin-top: 30px;"></div>
    <div class="row" id="reviewContainer">
        @foreach ($companyBooks as $index => $book)
            <div class="col-md-4 mb-4 review-item" style="{{ $index >= 6 ? 'display: none;' : '' }}">
                <div class="card h-100">
                    <div class="card-body">
                        
                        @if(isset($book['user']))
                            <div class="d-flex align-items-center mb-3 justify-content-between">
                                <div class="d-flex align-items-center">
                                    <!-- Placeholder image for profile -->
                                    <img src="https://via.placeholder.com/50/007bff/ffffff?text=👤" class="rounded-circle me-3" alt="{{ $book['user']['name'] }}" style="width: 50px; height: 50px;">
                                    <div>
                                        <h5 class="card-title mb-0">{{ $book['user']['name'] }}</h5>
                                        <p class="card-text"><small class="text-muted">{{ $book['user']['job'] }}</small></p>
                                    </div>
                                </div>
                                <div>
                                    <span class="text-danger"><i class="fa fa-heart"></i> {{ $book['likes_count'] ?? 0 }}</span>
                                </div>
                            </div>
                        @endif
                        <hr> <!-- 구분선 추가 -->
                        <div class="d-flex">
                            @if(isset($book['book']['title']))
                                <h5 class="card-title">{{ $book['book']['title'] }}</h5>
                            @endif
                        </div>
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                @if(isset($book['book']['description']))
                                    <p class="card-text">{{ \Illuminate\Support\Str::limit(strip_tags($book['book']['description']), 120, '...') }}<a href="{{ route('review.show', $book['id']) }}">더보기</a></p>
                                @endif
                            </div>
                            @if(isset($book['book']['thumbnail']))
                                <img src="{{ $book['book']['thumbnail'] }}" class="flex-shrink-0 ms-3" style="width: 100px; height: auto;">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @if(count($companyBooks) > 6)
        <div class="row">
            <div class="col-12 text-center">
                <button id="showMoreBtn" class="btn btn-outline-primary">더보기</button>
            </div>
        </div>
    @endif
</div>
<script>
    document.getElementById('showMoreBtn').addEventListener('click', function() {
        let hiddenItems = document.querySelectorAll('.review-item[style*="display: none"]');
        for (let i = 0; i < 6 && i < hiddenItems.length; i++) {
            hiddenItems[i].style.display = 'block';
        }
        if (hiddenItems.length <= 6) {
            this.style.display = 'none';
        }
    });
</script>
@endsection
