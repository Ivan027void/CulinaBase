<!DOCTYPE html> <html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CulinaBase</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="container">

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

            <div class="welcome">
                <h1>Welcome</h1>
                <p>Discover a world of delicious recipes for your favorite dishes and drinks.</p>
            </div>

            <div class="recipe-cards">
                @php
                    $counter = 0; // Initialize a counter variable
                @endphp

                @foreach($recipes as $recipe)
                    @if($counter < 9)
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
                        @php
                            $counter++; // Increment the counter variable
                        @endphp
                    @else
                        @break // Exit the loop after 9 iterations
                    @endif
                @endforeach
            </div>


            <section class="about-us-box">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="about-us-content text-center" style="background-image: url(gambar/bg4.jpg);">
                                <h2>About Us</h2>
                                <p>Website ini merupakan kumpulan resep masakan dari berbagai sumber. Kami menyediakan
                                    berbagai
                                    resep masakan,</p>
                                <p>mulai dari masakan Indonesia, masakan internasional, hingga masakan
                                    vegetarian.</p>
                                <p>Tujuan kami adalah untuk memudahkan para pecinta kuliner menemukan resep yang mereka
                                    cari. </p>
                                <p>Kami juga ingin berbagi informasi dan tips memasak kepada para pembaca.</p>
                                <a class="read-more" href="/about">Learn more about our team</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

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

</html>