<!DOCTYPE html> 
<html lang="en">
     <head> 
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>Resep {{ $recipe->recipe_name }}</title>
        <link rel="stylesheet" href="{{ asset('css/resep.css') }}">
    </head> 
    <body> 
        <div Class='Container'>
            <header> 
                <div class="navContainer"> 
                    <nav>
                        <ul id="navList">
                            <li>
                                <a id="navLogo" href="/">CulinaBase</a>
                            </li>
                            <li>
                                <div id="navItems">
                                    <a href="/">Home</a>
                                    <a href="/option">Recipe</a>
                                    <a href="/about">About</a>
                                    @auth
                                    @if (Auth::user()->isAdmin())
                                        <a href="/adminPage">{{ Auth::user()->name }}</a> <!-- Redirect admin users to adminPage -->
                                    @else
                                        <a href="/userPage">{{ Auth::user()->name }}</a> <!-- Redirect regular users to userPage -->
                                    @endif
                                @else
                                    <a href="/login">Login</a>
                                @endauth
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
            </header>
            <main>
            @if (file_exists(public_path('recipe/' . $recipe->gambar)))
            <!-- Gunakan gambar dari public/recipe jika ada -->
            <img src="{{ asset('recipe/' . $recipe->gambar) }}" alt="{{ $recipe->recipe_name }}">
            @else
            <!-- Fallback to the storage/app/public/images directory -->
            <img src="{{ asset('storage/' . $recipe->gambar) }}" alt="{{ $recipe->recipe_name }}">
            @endif
                <h1>{{ $recipe->recipe_name }}</h1>
                <p>Penulis: {{ $author->name ?? '-'}}</p>
                <h2>Deskripsi</h2>
                <p>{{$recipe->description }}</p>
                <p>Waktu Persiapan: {{ $recipe->preparation_time }}</p>
                <p>Waktu Memasak: {{ $recipe->cooking_time }}</p>

                <h3>Bahan-bahan:</h3>
                <ul>
                    @foreach ($ingredients as $ingredient)
                        <li>{{ $ingredient->quantity }} {{ $ingredient->size }} {{ $ingredient->ingredient_name }}, {{ $ingredient->note }}</li>
                    @endforeach
                </ul>

                <h3>Cara Memasak:</h3>
                <ol type="1">
                    @foreach ($recipe->steps as $step)
                    <li>{{ $step->description }}</li>
                    @endforeach
                </ol>

                <button class="btn_kembali" onclick="redirectToPreviousPage()">Back</button>

<script>
function redirectToPreviousPage() {
    // Check if the user is logged in
    @auth
        // Check if the user is an admin
        @if (Auth::user()->isAdmin())
            window.location.href = '/adminPage'; // Redirect admin users to adminPage
        @else
            window.location.href = '/userPage'; // Redirect regular users to userPage
        @endif
    @else
        window.history.back(); // Not logged in, go back in history
    @endauth
}
</script>


            </main>

            
        @include('sweetalert::alert')
        <script>
            @if (session('success'))
                swal({
                    title: "Success",
                    text: "{{ session('success') }}",
                    icon: "success",
                });
            @elseif(session('error'))
            swal({
                title: "Error",
                text: "{{ session('error') }}",
                icon: "error",
            });
            @elseif(session('warning'))
            swal({
                title: "Warning",
                text: "{{ session('warning') }}",
                icon: "warning",
            });
            @endif
            </script>

            <main>
                <div class="review_layout">
                    <div class="masukan_review">
                        <form action="/review-post" method="post" id="reviewForm">
                            @csrf
                            <input type="hidden" name="recipe_id" value="{{ $recipe->recipe_id }}">
                            <div class="input_data mb-3">
                                <label for="R_nama" style="font-weight: bold; font-family: 'Times New Roman', serif;">Masukan
                                    Nama</label>
                                @auth
                                <input class="input_nama" type="text" name="user_name" value="{{ Auth::user()->name }}" disabled>
                                @else
                                <input class="input_nama @error('user_name') is-invalid @enderror" type="text" name="R_nama"
                                    placeholder="Masukan Nama Anda Disini">
                                @endauth
                            </div>
                            <div class="input_data mb-3">
                                <label for="isi_review" style="font-weight: bold; font-family: 'Times New Roman', serif;">Tulis
                                    review</label>
                                <textarea class="input_review @error('isi_review') is-invalid @enderror" name="isi_review"
                                    placeholder="Review...."></textarea>
                            </div>
                            <div class="button">
                                <button type="submit" class="btn btn-outline-dark"
                                    style="float: right; margin-top: 5px; background-color: rgb(144, 222, 255); width: 100px; height: 45px;">
                                    post
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            
                <div class="container">
                    <div class="row">
                        @foreach($reviews as $review)
                        @if($review->recipe_id == $recipe->recipe_id)
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="reviews">
                                        <h3>{{ $review->reviewer_name }}<span style="color: gray; font-size: 12px;"> {{
                                                $review->created_at->format('d M Y') }}</span></h3>
                                        <p>"{{ $review->review_content }}"</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </main>
              <footer>
                <div class="footerBox">
                    <p>Copyright &copy; CulinaBase kelompok Sistem Informasi</p>
                </div>
            </footer>
        </div>
    </body>
</html>