<!DOCTYPE html> <html lang="en"> <head> <meta charset="UTF-8"> <meta name="viewport"
    content="width=device-width, initial-scale=1.0">
<title>Login</title>
<link rel="stylesheet" href="css/loginregis.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
@include('sweetalert::alert')
<script>
    // SweetAlert initialization code
    Swal.fire({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
    });
</script>

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
        @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
            });
        </script>
    @endif
        <main>
            <div class="formarea">
                <p class="log-title">Login Form</p>
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