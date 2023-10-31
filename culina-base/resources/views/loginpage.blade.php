<!DOCTYPE html> <html lang="en"> <head> <meta charset="UTF-8"> <meta name="viewport"
    content="width=device-width, initial-scale=1.0">
<title>Login</title>
<link rel="stylesheet" href="css/loginregis.css">
</head>

<body>
    <div class='container' style="background-image: url(gambar/bg5.jpg);">
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
                                <a href="/regis">Sign in</a>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>
        <main>
            <div class="formarea">
                <form method="Post" action="{{ route('login') }}">
                    @csrf
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password">
                    <div class=button-container>
                        <button class="btn_kembali" type="button" onclick="window.location.href='/'">Kembali</button>
                        <button class="btn_submit" type="submit">Login</button>
                    </div>
                    <div class='noAccount'>
                        <p>Belum punya akun?<a href="/regis">Sign Up</p>
                    </div>
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