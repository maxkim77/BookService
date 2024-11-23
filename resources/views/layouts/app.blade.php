<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BookTrunk') }}</title>
        <!-- Favicons -->
        <link rel="icon" href="path/to/favicon-notification.ico" type="image/x-icon">
    <link rel="icon" href="path/to/favicon-bookmark.ico" type="image/x-icon">
    <link rel="icon" href="path/to/favicon-profile.ico" type="image/x-icon">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/custom.css'])

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- app layout 입니다. -->
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-custom shadow-sm">
            <div class="container d-flex justify-content-between">
                <a class="navbar-brand" href="{{ url('/') }}">
                BookTrunk
                </a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Centered Navbar Links -->
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('my.library') }}">마이서재</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('company.library') }}">회사서재</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="}">소셜서재</a>
                        </li>
 
                    </ul>
                    <button class="btn btn-circle" id="toggleReviewModalButton">
                    <i class="fas fa-pencil-alt"></i>
</button>   

                    <div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="reviewModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                
                                <div class="modal-header">
                                    <h4 class="modal-title" id="reviewModalLabel">글쓰기</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="max-height: 80vh; overflow-y: auto;">
                                    <div id="searchContainer">
                                        <div class="form-group">
                                            <input type="text" id="keyword" class="form-control" placeholder="검색할 책의 키워드를 입력하세요">
                                            <button class="btn btn-primary mt-2" onclick="searchBook()">검색</button>
                                        </div>
                                        <div id="searchResults" class="row"></div>
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
                                        <input type="hidden" name="shared_with[]" value="my_library">
                                        
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
                                            <label for="review_title">Review Title</label>
                                            <input class="form-control" id="review_title" name="review_title" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="review_category">Review Category</label>
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
                            </div>
                        </div>
                    </div>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">로그인</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">회원가입</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        로그아웃
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

            <main class="py-4 content">
            <div class="container">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        $(document).ready(function() {
            $('.dropdown-toggle').dropdown();

            // Show modal on button click
            $('#toggleReviewModalButton').on('click', function() {
                $('#reviewModal').modal('show');
            });

            // Close modal on button click
            $('#closeReviewModalButton').on('click', function() {
                $('#reviewModal').modal('hide');
            });
        });

        function searchBook() {
            const keyword = document.getElementById('keyword').value;
            console.log('Searching for books with keyword:', keyword);

            axios.get(`/api/books?keyword=${encodeURIComponent(keyword)}`)
                .then(response => {
                    console.log('API response:', response);
                    const books = response.data.data;
                    console.log('Books data:', books);

                    if (!Array.isArray(books)) {
                        console.error('Expected an array but got:', books);
                        alert('Unexpected data format. Please try again.');
                        return;
                    }

                    const resultsDiv = document.getElementById('searchResults');
                    resultsDiv.innerHTML = '';

                    books.forEach(book => {
                        const bookDiv = document.createElement('div');
                        bookDiv.classList.add('col-md-3', 'mb-4');
                        bookDiv.innerHTML = `
                            <div class="card">
                                <img src="${book.thumbnail}" class="card-img-top" alt="${book.title}" style="max-height: 200px;">
                                <div class="card-body">
                                    <h5 class="card-title">${book.title}</h5>
                                    <p class="card-text"><strong>Authors:</strong> ${book.author.join(', ')}</p>
                                    <p class="card-text"><strong>Categories:</strong> ${book.category.join(', ')}</p>
                                    <button class="btn btn-primary" onclick="selectBook('${book.id}', '${encodeURIComponent(book.title)}', '${book.thumbnail}', '${encodeURIComponent(book.description || '')}', '${encodeURIComponent(book.author.join(', '))}', '${encodeURIComponent(book.category.join(', '))}')">Select</button>
                                </div>
                            </div>
                        `;
                        resultsDiv.appendChild(bookDiv);
                    });
                })
                .catch(error => {
                    console.error('Error fetching books:', error);
                    alert('An error occurred while fetching books. Please try again.');
                });
        }

        function selectBook(id, title, thumbnail, description, authors, categories) {
            document.getElementById('book_id').value = id;
            document.getElementById('title').value = decodeURIComponent(title);
            document.getElementById('thumbnail').value = thumbnail;
            document.getElementById('description').value = decodeURIComponent(description);
            document.getElementById('authors').value = decodeURIComponent(authors);
            document.getElementById('categories').value = decodeURIComponent(categories);

            // Display selected book information in the modal
            document.getElementById('selectedBook').style.display = 'block';
            document.getElementById('selectedBookThumbnail').src = thumbnail;
            document.getElementById('selectedBookTitle').innerText = decodeURIComponent(title);
            document.getElementById('selectedBookAuthors').innerText = decodeURIComponent(authors);
            document.getElementById('selectedBookCategories').innerText = decodeURIComponent(categories);

            // Hide search results
            document.getElementById('searchResults').innerHTML = '';
        }

        //d
    </script>
</body>
</html>

