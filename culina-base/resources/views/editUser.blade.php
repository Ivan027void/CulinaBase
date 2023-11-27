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
                                @auth
                                <a href="/profle">{{Auth::user()->name }}</a>
                                @else
                                user
                                @endauth
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>

        @include('sweetalert::alert')
        <script>
            @if (session('success'))
                swal({
                    title: "Success",
                    text: "{{ session('success') }}",
                    icon: "success",
                });
            @elseif(session('error'))
            swal({
                title: "Error",
                text: "{{ session('error') }}",
                icon: "error",
            });
            @elseif(session('warning'))
            swal({
                title: "Warning",
                text: "{{ session('warning') }}",
                icon: "warning",
            });
            @endif
            </script>

         
       
        <main>

        <div class="form-header" onclick="toggleLanguage()">
            <h1 id="formTitleEnglish">Edit Recipe</h1>
            <h1 id="formTitleIndonesia" style="display: none;">Edit Resep</h1>
        
            <p id="formInfoEnglish">Edit your recipe here!</p>
            <p id="formInfoIndonesia" style="display: none;">Modifikasi resep di form ini!</p>
        
            <p id="fillFormEnglish">Fill in the form below to modify your recipe.</p>
            <p id="fillFormIndonesia" style="display: none;">Isi formulir di bawah untuk mengedit resep Anda.</p>
        
            <p id="requiredFieldsEnglish">Please fill in all required fields marked with <span class="required">*</span></p>
            <p id="requiredFieldsIndonesia" style="display: none;">Silakan isi semua kolom yang wajib diisi yang ditandai dengan
                <span class="required">*</span></p>
        
        </div>
<div class="inforesep">
    <h2 class="recipe_title">{{ $recipe->recipe_name }}</h2>
    @if (file_exists(public_path('recipe/' . $recipe->gambar)))
    <!-- Gunakan gambar dari public/recipe jika ada -->
    <img src="{{ asset('recipe/' . $recipe->gambar) }}" alt="{{ $recipe->recipe_name }}">
    @else
    <!-- Fallback to the storage/app/public/images directory -->
    <img src="{{ asset('storage/' . $recipe->gambar) }}" alt="{{ $recipe->recipe_name }}">
    @endif
    <br>
</div>


        <form action="{{ route('update-recipe', ['id' => $recipe->recipe_id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
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
                <input type="text" class="form-control" id="preparation_time" name="preparation_time"
                    value="{{ $recipe->preparation_time }}">
            </div>
        
            <div class="form-group">
                <label for="cooking_time">Waktu Memasak</label>
                <input type="text" class="form-control" id="cooking_time" name="cooking_time"
                    value="{{ $recipe->cooking_time }}">
            </div>
        
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
        
        @if ($errors->any())
        <div class="warning">
            <p>Please fix the errors in the form and try again.</p>
            <p>Please fill in all required fields marked with <span class="required">*</span></p>
        </div>
        @endif
        
        
        <button class="btn_kembali" onclick="window.location.href='/userPage'">Back</button>
        </main>

        <script>
    function toggleLanguage() {
        toggleVisibility('formTitleEnglish', 'formTitleIndonesia');
        toggleVisibility('formInfoEnglish', 'formInfoIndonesia');
        toggleVisibility('fillFormEnglish', 'fillFormIndonesia');
        toggleVisibility('requiredFieldsEnglish', 'requiredFieldsIndonesia');
    }

    function toggleVisibility(idEnglish, idIndonesia) {
        const elementEnglish = document.getElementById(idEnglish);
        const elementIndonesia = document.getElementById(idIndonesia);

        // Toggle visibility based on current state
        const isEnglishVisible = elementEnglish.style.display !== 'none';

        elementEnglish.style.display = isEnglishVisible ? 'none' : 'block';
        elementIndonesia.style.display = isEnglishVisible ? 'block' : 'none';
    }
</script>

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