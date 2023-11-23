@include('sweetalert::alert')
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
                                @auth
                                <a href="/profile">{{Auth::user()->name }}</a>
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
        <form method="POST" action="{{ route('add-recipe') }}" enctype="multipart/form-data">
            @csrf
            <label for="name">Recipe Name<span class="required">*</span>:</label>
            <input type="text" name="recipe_name" id="name" required>

            <label for="image">Food Image<span class="required">*</span>:</label>
            <input type="file" name="gambar" id="image" required>

            <label for="description">Description:</label>
            <textarea name="description" id="description" rows="4"></textarea>

            <label for="prep_time">Preparation Time (minutes)<span class="required">*</span>:</label>
            <input type="text" name="preparation_time" id="prep_time" required>

            <label for="cook_time">Cooking Time (minutes)<span class="required">*</span>:</label>
            <input type="text" name="cooking_time" id="cook_time" required>

            <button class="upload" type="submit">Upload Recipe</button>
        </form>
        <div class="warning">
            <p>Please fill in all required fields marked with <span class="required">*</span></p>
        </div>


        <button class="btn_kembali" onclick="window.location.href='/adminPage'">Back</button>
        </main>

        <footer>
            <div class="footerBox">
                <p>
                    Copyright &copy; CulinaBase kelompok Sistem Informasi
                </p>
            </div>
        </footer>

        @if(session('notification'))
        <script>
            swal({
                title: "{{ session('notification.title') }}",
                text: "{{ session('notification.text') }}",
                icon: "{{ session('notification.icon') }}",
            });
        </script>
        @endif
    </div>
</body>

</html>