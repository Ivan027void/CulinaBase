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
                <label for="name">Recipe Name:</label>
                <input type="text" name="name" id="name">

                <label for="image">Food Image:</label>
                <input type="file" name="image" id="image">

                <label for="description">Description:</label>
                <textarea name="description" id="description" rows="4"></textarea>

                <label for="prep_time">Preparation Time (minutes):</label>
                <input type="number" name="prep_time" id="prep_time">

                <label for="cook_time">Cooking Time (minutes):</label>
                <input type="number" name="cook_time" id="cook_time">

                <label for="ingredients">Ingredients:</label>
                <div id="ingredients-container">
                    <div class="ingredient-row">
                        <input type="text" name="ingredients[]" class="ingredient-input" required>
                        <button type="button" class="remove-ingredient">Remove</button>
                    </div>
                </div>
                <button type="button" id="add-ingredient">Add Ingredient</button>

                <label for="steps">Steps:</label>
                <div id="steps-container">
                    <div class="step-row">
                        <textarea name="steps[]" class="step-input" rows="4" required></textarea>
                        <button type="button" class="remove-step">Remove</button>
                    </div>
                </div>
                <button type="button" id="add-step">Add Step</button>

                <label for="categories">Categories:</label>
                <select name="categories[]" multiple>
                    <option value="breakfast">Breakfast</option>
                    <option value="lunch">Lunch</option>
                    <option value="dinner">Dinner</option>
                    <!-- Add more category options here -->
                </select>

                <button type="submit">Upload Recipe</button>
            </form>


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

    <script>
        // JavaScript code for adding dynamic ingredient and step fields
        document.getElementById('add-ingredient').addEventListener('click', function () {
            const ingredientInput = document.createElement('div');
            ingredientInput.className = 'ingredient-row';
            ingredientInput.innerHTML = `
                <input type="text" name="ingredients[]" class="ingredient-input" required>
                <button type="button" class="remove-ingredient">Remove</button>
            `;
            document.getElementById('ingredients-container').appendChild(ingredientInput);
        });

        document.getElementById('add-step').addEventListener('click', function () {
            const stepInput = document.createElement('div');
            stepInput.className = 'step-row';
            stepInput.innerHTML = `
                <textarea name="steps[]" class="step-input" rows="4" required></textarea>
                <button type="button" class="remove-step">Remove</button>
            `;
            document.getElementById('steps-container').appendChild(stepInput);
        });

        // JavaScript code for removing ingredient and step fields
        document.getElementById('ingredients-container').addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-ingredient')) {
                e.target.parentElement.remove();
            }
        });

        document.getElementById('steps-container').addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-step')) {
                e.target.parentElement.remove();
            }
        });
    </script>

</body>

</html>