<!DOCTYPE html>
<html>

<head>
    <title>Food-Recipes</title>

    <link rel="stylesheet" type="text/css" href="css/option.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>

<body>
    <div class="container">
        <header>
            <div class="navContainer">
                <nav>
                    <ul id="navList">
                        <li>
                        <div>
                            <span style="font-size: 20px;margin-top: 50px;">
                            <a id="navLogo" href="/"><span style="color:#ff9900">(CulinaBase)</span></a>
                            </span>
                        </div>
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
        <br>
        <center>
            <form name="search" action="/search" method="POST">
                <input type="text" id="search" name="reg" placeholder="Search...">
            </form>
        </center>
        <br><br>
        <main>
        <div class="recipe-cards">
                @foreach($recipes as $recipe)
                        <div class="recipe-card">
                            <a href="/recipe_info/{{ $recipe->recipe_id }}">
                            @if (file_exists(public_path('recipe/' . $recipe->gambar)))
                                <!-- Gunakan gambar dari public/recipe jika ada -->
                                <img src="{{ asset('recipe/' . $recipe->gambar) }}" alt="{{ $recipe->recipe_name }}">
                            @else
                                <!-- Fallback to the storage/app/public/images directory -->
                                <img src="{{ asset('storage/' . $recipe->gambar) }}" alt="{{ $recipe->recipe_name }}">
                            @endif
                                <h2 class="recipe_title">{{ $recipe->recipe_name }}</h2>
                                <p>{{ Str::limit($recipe->description, 80, '...') }}</p>
                                <a class="read-more" href="/recipe_info/{{ $recipe->recipe_id }}">Lanjutkan Membaca</a>
                            </a>
                        </div>
                @endforeach
            </div>
        </main>
        <footer>
            <div class="footerBox">
                <p>
                    Copyright &copy; CulinaBase kelompok Sistem Informasi
                </p>
            </div>
        </footer>
    </div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
    $(document).ready(function () {
        $('#search').keyup(function () {
            var text = $(this).val().toLowerCase(); // Convert input to lowercase for case-insensitive search
            $('.recipe-card').each(function () {
                var recipeName = $(this).find('.recipe_title').text().toLowerCase();
                if (recipeName.includes(text)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>

</html>