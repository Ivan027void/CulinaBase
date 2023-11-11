<!DOCTYPE html> 
<html lang="en">
     <head> 
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>Resep {{ $recipe->recipe_name }}</title>
        <link rel="stylesheet" href="{{ asset('css/adminForm.css') }}">
    </head> 
    <body> 
    <div id="floating-area" class="floating-area">
                <a href="#top">Top</a> |
                <a href="#bahan">Bahan</a> |
                <a href="#langkah">Langkah</a>
            </div>
        <div Class='Container' id="top">
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
            @if (file_exists(public_path('recipe/' . $recipe->gambar)))
            <!-- Gunakan gambar dari public/recipe jika ada -->
            <img src="{{ asset('recipe/' . $recipe->gambar) }}" alt="{{ $recipe->recipe_name }}">
            @else
            <!-- Fallback to the storage/app/public/images directory -->
            <img src="{{ asset('storage/' . $recipe->gambar) }}" alt="{{ $recipe->recipe_name }}">
            @endif
            <h1>{{ $recipe->recipe_name }}</h1>
            <p>Penulis: {{ $author->name ?? '-'}}</p>
            <h2>Deskripsi</h2>
            <p>{{$recipe->description }}</p>
            <p>Waktu Persiapan: {{ $recipe->preparation_time }}</p>
            <p>Waktu Memasak: {{ $recipe->cooking_time }}</p>
            

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

            <form action="{{ route('recipes.update', ['id' => $recipe->recipe_id]) }}" method="post" enctype="multipart/form-data">
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
                <input type="text" class="form-control" id="preparation_time" name="preparation_time" value="{{ $recipe->preparation_time }}">
            </div>

            <div class="form-group">
                <label for="cooking_time">Waktu Memasak</label>
                <input type="text" class="form-control" id="cooking_time" name="cooking_time" value="{{ $recipe->cooking_time }}">
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>

        <div class="warning">
            <p>Please fill in all required fields marked with <span class="required">*</span></p>
        </div>


        <div id="bahan">
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
            <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($ingredient as $item)
            <tr>
                <td>{{ $item->ingredient_name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->size }}</td>
                <td>{{ $item->note }}</td>
                <td>
                <div class="button-container">
                    <div class="button-row-1">
                        <button type="button" class="edit-ingredient" data-ingredientid="{{ $item->id }}">Edit</button>
                        <form
                            action="{{ route('ingredients.delete', ['recipe_id' => $recipe->recipe_id, 'ingredientId' => $item->ingredient_id]) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" id="delete-ingredient"
                                onclick="return confirm('Are you sure you want to delete this ingredient?')">Delete</button>
                        </form>
                    </div>
                </div>
                </td>
            </tr>

            @endforeach
            </tbody>
        </table>
        @endif


        <form method="POST" action="{{ route('ingredients.add', ['recipe_id' => $recipe->recipe_id]) }}"
            enctype="multipart/form-data">
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
            </div>
        </form>

         <!-- Update Ingredient Form -->
         <div id="update-ingredient-form" style="display: none;">
            <h3>Update Ingredient</h3>
            <form method="POST"
                action="{{ route('ingredients.update', ['recipe_id' => $recipe->recipe_id, 'ingredientId' => $item->ingredient_id]) }}"
                id="update-ingredient-form">
                @method('PUT')
                @csrf
                <input type="text" name="ingredient_name" id="update-ingredient-name" placeholder="Ingredient Name" required>
                <input type="text" name="quantity" id="update-ingredient-quantity" placeholder="Quantity">
                <input type="text" name="size" id="update-ingredient-size" placeholder="Size" >
                <input type="text" name="note" id="update-ingredient-note" placeholder="Note" >
                <button id="ingredient-update" type="submit">Update Ingredient</button>
                <button type="button" id="cancel-update-ingridients">Cancel</button>
            </form>
        </div>
</div>

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

            <div id="langkah">
            <h3>Cara Memasak:</h3>
                @if ($steps->isEmpty())
            <p>No steps.</p>
            @else
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($steps as $step)
                    <tr>
                        <td>{{ $step->step_order }}</td>
                        <td>{{ $step->description }}</td>
                        <td>
                        <div class="button-container">
                            <div class="button-row-1">
                                <button type="button" class="edit-step" data-stepid="{{ $step->id }}">Edit</button>
                                <form action="{{ route('steps.delete', ['id'=> $recipe->recipe_id, 'stepId' => $step->step_id]) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" id="delete-step"
                                        onclick="return confirm('Are you sure you want to delete this step?')">Delete</button>
                                </form>
                            </div>
                        </div>
                        </td>
                    </tr>
                
                    @endforeach
                </tbody>
            </table>
            @endif

             <!-- Add Step Form -->
             <form method="POST" action="{{ route('steps.add', $recipe->recipe_id) }}">
                @csrf
                <label for="description">Add Step:</label>
                <input type="text" name="step_order" placeholder="Step Order" required>
                <input type="text" name="description" placeholder="Description" required>
                <button type="submit">Add Step</button>
            </form>

             <!-- Update Step Form -->
             <div id="update-step-form" style="display: none;">
                <h3>Update Step</h3>
                <form method="POST" action="{{ route('steps.update', ['id' => $recipe->recipe_id, 'stepId' => $step->step_id]) }}" id="update-step-form">
                    @method('PUT')
                    @csrf
                    <input type="text" name="step_order" id="update-step-order" placeholder="Step Order" required>
                    <input type="text" name="description" id="update-step-description" placeholder="Description" required>
                    <button id="step-update" type="submit">Update Step</button>
                    <button type="button" id="cancel-update-steps">Cancel</button>
                </form>
            </div>
</div>
               <div id="button-container">
                <div class="button-row-1">
                    <button class="btn_kembali" onclick="window.location.href='/adminPage'">Back</button>
                </div>
            </div>
            </main>
            
            <footer>
                <div class="footerBox">
                    <p>Copyright &copy; CulinaBase kelompok Sistem Informasi</p>
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

    document.querySelectorAll('.edit-ingredient').forEach(function (button) {
        button.addEventListener('click', function () {
            // Fetch the ingredient details and populate the update form
            let ingredientId = button.getAttribute('data-ingredientid');
            let ingredient = {!! json_encode($ingredient->keyBy('id')->toArray(), JSON_HEX_TAG) !!}[ingredientId];
            document.getElementById('update-ingredient-form').action = `/adminPage/{{ $recipe->recipe_id }}/updateIngredient/${ingredientId}`;
            document.getElementById('update-ingredient-name').value = ingredient.ingredient_name;
            document.getElementById('update-ingredient-quantity').value = ingredient.quantity;
            document.getElementById('update-ingredient-size').value = ingredient.size;
            document.getElementById('update-ingredient-note').value = ingredient.note;
            document.getElementById('update-ingredient-form').style.display = 'block';
        });
    });

    // Cancel Update button click event
document.getElementById('cancel-update-ingridients').addEventListener('click', function () {
    document.getElementById('update-ingredient-form').style.display = 'none';
});


    // Edit Step button click event
    document.querySelectorAll('.edit-step').forEach(function (button) {
        button.addEventListener('click', function () {
            // Fetch the step details and populate the update form
            let stepId = button.getAttribute('data-stepid');
            let step = {!! json_encode($steps->keyBy('id')->toArray(), JSON_HEX_TAG) !!}[stepId];
            document.getElementById('update-step-form').action = `/adminPage/{{ $recipe->recipe_id }}/update-step/${stepId}`;
            document.getElementById('update-step-order').value = step.step_order;
            document.getElementById('update-step-description').value = step.description;
            document.getElementById('update-step-form').style.display = 'block';
        });
    });

    // Cancel Update Step button click event
    document.getElementById('cancel-update-steps').addEventListener('click', function () {
        document.getElementById('update-step-form').style.display = 'none';
    });
</script>
<script>
        // Show or hide the floating area based on scroll position
        window.onscroll = function () {
            scrollFunction();
        };

        function scrollFunction() {
            var floatingArea = document.getElementById("floating-area");
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                floatingArea.style.display = "block";
            } else {
                floatingArea.style.display = "none";
            }
        }

        // Smooth scrolling when clicking on links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();

                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>

    </body>
</html>