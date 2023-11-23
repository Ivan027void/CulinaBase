<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{auth()->user()->role}} Profile</title>
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
            @include('sweetalert::alert')
            <section class="form-update">
                <h1>Update Profile</h1>
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

                        <button type="submit">Update</button>
                    </form>
                </div>
            </section>

            <div class="button-row-1">
                @if(auth()->user()->role == 'admin')
                <button class="btn_kembali" onclick="window.location.href='/adminPage'">Back</button>
                @else
                <button class="btn_kembali" onclick="window.location.href='/userPage'">Back</button>
                @endif
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

    <!-- Include SweetAlert library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Your existing HTML code -->

    <!-- Script for displaying a success alert -->
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000
            });
        @endif
    </script>
</body>

</html>