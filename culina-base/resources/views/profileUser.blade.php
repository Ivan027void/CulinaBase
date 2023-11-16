@include('sweetalert::alert')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="{{ asset('css/userProfile.css') }}">
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
                                @auth
                                <a href="/userPage">{{ Auth::user()->name }}</a>
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
        <div class="profile-form-container">
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PUT')

                <!-- Update profile form fields -->
                <label for="name">Name:</label>
                <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required>

                <label for="email">Email:</label>
                <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>

                <label for="password">New Password:</label>
                <input type="password" name="password">

                <label for="password_confirmation">Confirm Password:</label>
                <input type="password" name="password_confirmation">

                <button type="submit">Update Profile</button>
            </form>
        </div>

                <div class="button-container">
                    <div class="button-row-1">
                        <button class="btn_kembali" onclick="window.location.href='/userPage'">Back</button>
                    </div>
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