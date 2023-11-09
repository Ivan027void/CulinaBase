<!DOCTYPE html> <html lang="en"> <head> <meta charset="UTF-8"> <meta name="viewport" content="width=device-width,
    initial-scale=1.0"> <title>add ingredient</title>
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
            <h2 class="recipe_title">{{ $recipe->recipe_name }}</h2>
             <p>{{ Str::limit($recipe->description, 80, '...') }}</p>

             <h3>Bahan-bahan:</h3>

            @if ($ingredient->isEmpty())
                <p>No ingredient.</p>
            @else
                <table>
                    <thead>
                        <tr>
                            <th>Nama Bahan</th>
                            <th>Quantity</th>
                            <th>Size</th>
                            <th>Note</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ingredient as $item)
                            <tr>
                                <td>{{ $item->ingredient_name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->size }}</td>
                                <td>{{ $item->note }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

             <!-- Display validation errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <form method="POST" action="{{ route('ingredients.store', ['recipe_id' => $recipe->recipe_id]) }}" enctype="multipart/form-data">
                @csrf
                <label for="ingredients">Ingredients:</label>
                <div id="ingredients-container">
                    <div class="ingredient-row">
                        <input type="text" name="ingredients[]" class="ingredient-input" placeholder="Nama bahan" required>
                        <input type="text" name="quantity[]" class="quantity-input" placeholder="Quantity">
                        <input type="text" name="size[]" class="size-input" placeholder="Size">
                        <input type="text" name="note[]" class="note-input" placeholder="Note">
                        <button type="button" class="remove-ingredient">Remove</button>
                    </div>
                </div>
                <div class="button-container">
                <div class="button-row-1">
                    <button type="button" id="add-ingredient">Add Ingredient</button>
                    <button type="submit">Submit Ingredients</button>
                </div>
                <div class="button-row-2">
                    <button class="btn_kembali" onclick="window.location.href='/userPage'">Back</button>
                </div>
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

    <script>
    document.getElementById('add-ingredient').addEventListener('click', function () {
        const ingredientInput = document.createElement('div');
        ingredientInput.className = 'ingredient-row';
        ingredientInput.innerHTML = `
            <input type="text" name="ingredients[]" class="ingredient-input" placeholder="Nama Bahan" required>
            <input type="text" name="quantity[]" class="quantity-input" placeholder="Quantity">
            <input type="text" name="size[]" class="size-input" placeholder="Size">
            <input type="text" name="note[]" class="note-input" placeholder="Note">
            <button type="button" class="remove-ingredient">Remove</button>
        `;
        document.getElementById('ingredients-container').appendChild(ingredientInput);
    });

    document.getElementById('ingredients-container').addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-ingredient')) {
            e.target.parentElement.remove();
        }
    });
</script>


</body>

</html>