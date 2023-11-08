<!DOCTYPE html> <html lang="en"> <head> <meta charset="UTF-8"> <meta name="viewport" content="width=device-width,
    initial-scale=1.0"> <title>Upload Recipe</title>
<link rel="stylesheet" href="css/userform.css">
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
            <form method="POST" action="#" enctype="#">
            @csrf
            <label for="name">Recipe Name<span class="required">*</span>:</label>
            <input type="text" name="name" id="name" required>

            <label for="image">Food Image<span class="required">*</span>:</label>
            <input type="file" name="image" id="image" required>

            <label for="description">Description:</label>
            <textarea name="description" id="description" rows="4"></textarea>

            <label for="prep_time">Preparation Time (minutes)<span class="required">*</span>:</label>
            <input type="text" name="prep_time" id="prep_time" required>

            <label for="cook_time">Cooking Time (minutes)<span class="required">*</span>:</label>
            <input type="text" name="cook_time" id="cook_time" required>

            <button class="upload" type="submit">Upload Recipe</button>
        </form>
        <div class="warning">
            <p>Please fill in all required fields marked with <span class="required">*</span></p>
        </div>


            <div class="logout">
                <form method="post" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn_logout"type="submit" class="btn btn-light button-link">Logout</button>
                </form>
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

</html>