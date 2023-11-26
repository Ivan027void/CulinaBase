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
        <div class="form-header" onclick="toggleLanguage()">
            <h1 id="formTitleEnglish">Upload Recipe</h1>
            <h1 id="formTitleIndonesia" style="display: none;">Unggah Resep</h1>
        
            <p id="formInfoEnglish">Upload your recipe here!</p>
            <p id="formInfoIndonesia" style="display: none;">Unggah resep di form ini!</p>
        
            <p id="fillFormEnglish">Fill in the form below to upload your recipe.</p>
            <p id="fillFormIndonesia" style="display: none;">Isi formulir di bawah untuk mengunggah resep Anda.</p>
        
            <p id="requiredFieldsEnglish">Please fill in all required fields marked with <span class="required">*</span></p>
            <p id="requiredFieldsIndonesia" style="display: none;">Silakan isi semua kolom yang wajib diisi yang ditandai dengan
                <span class="required">*</span></p>
        </div>
        
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


            
        <form method="POST" action="{{ route('create-recipe') }}" enctype="multipart/form-data">
            @csrf
        
            <label for="name">Recipe Name<span class="required">*</span>:</label>
            <input type="text" name="recipe_name" id="name" value="{{ old('recipe_name') }}" required>
            @error('recipe_name')
            <div class="error">{{ $message }}</div>
            @enderror
        
            <label for="image">Food Image<span class="required">*</span>:</label>
            <input type="file" name="gambar" id="image" required>
            @error('gambar')
            <div class="error">{{ $message }}</div>
            @enderror
        
            <label for="description">Description:</label>
            <textarea name="description" id="description" rows="4">{{ old('description') }}</textarea>
        
            <label for="prep_time">Preparation Time (menit atau jam)<span class="required">*</span>:</label>
            <input type="text" name="preparation_time" id="prep_time" value="{{ old('preparation_time') }}" required>
            @error('preparation_time')
            <div class="error">{{ $message }}</div>
            @enderror
        
            <label for="cook_time">Cooking Time (menit atau jam)<span class="required">*</span>:</label>
            <input type="text" name="cooking_time" id="cook_time" value="{{ old('cooking_time') }}" required>
            @error('cooking_time')
            <div class="error">{{ $message }}</div>
            @enderror
        
            <button class="upload" type="submit">Upload Recipe</button>
        </form>
        
        @if ($errors->any())
        <div class="warning">
            <p>Please fix the errors in the form and try again.</p>
            <p>Please fill in all required fields marked with <span class="required">*</span></p>
        </div>
        @endif



        <button class="btn_kembali" onclick="window.location.href='/userPage'">Back</button>
        </main>

        <footer>
            <div class="footerBox">
                <p>
                    Copyright &copy; CulinaBase kelompok Sistem Informasi
                </p>
            </div>
        </footer>

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