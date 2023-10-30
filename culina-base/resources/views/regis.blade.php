<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link rel="stylesheet" href="css/loginregis.css">
</head>

<body>
    <div class='container'style="background-image: url(gambar/bg2.jpg);">
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
                                <a href="/login">Login</a>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>
        <main>
            <form method="POST" action="#">
                @csrf
                <label for="name">Name:</label>
                <input type="text" name="name" id="name">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email">
                <label for="phone">Phone:</label>
                <input type="text" name="phone" id="phone">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password">
                <label for="password_confirmation">Confirm Password:</label>
                <input type="password" name="password_confirmation" id="password_confirmation">
                <button type="submit" href="/userPage">Register</button>
                <div>
                    <p>Sudah punya akun? <a href="/login">Sign in</a></p>
                </div>
            </form>

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