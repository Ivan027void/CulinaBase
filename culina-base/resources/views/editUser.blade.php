<!DOCTYPE html> <html lang="en"> <head> <meta charset="UTF-8"> <meta name="viewport" content="width=device-width,
    initial-scale=1.0"> <title>Upload Recipe</title>
<link rel="stylesheet" href="{{ asset('css/userform.css') }}">
</head>

<body>
    <div class='container'>
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
                                <a href="/">{{Auth::user()->name }}</a>
                                @else
                                user
                                @endauth
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>

        <main>
        <form action="#" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="recipe_name">Nama Resep</label>
                <input type="text" class="form-control" id="recipe_name" name="recipe_name" value="{{ $recipe->recipe_name }}">
            </div>

            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea class="form-control" id="description" name="description">{{ $recipe->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="preparation_time">Waktu Persiapan</label>
                <input type="text" class="form-control" id="preparation_time" name="preparation_time" value="{{ $recipe->preparation_time }}">
            </div>

            <div class="form-group">
                <label for="cooking_time">Waktu Memasak</label>
                <input type="text" class="form-control" id="cooking_time" name="cooking_time" value="{{ $recipe->cooking_time }}">
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>

        <div class="warning">
            <p>Please fill in all required fields marked with <span class="required">*</span></p>
        </div>


        <button class="btn_kembali" onclick="window.location.href='/userPage'">Back</button>
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