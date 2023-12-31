<!DOCTYPE html> <html lang="en"> <head> <meta charset="UTF-8"> <meta name="viewport" content="width=device-width,
    initial-scale=1.0"> <title>add ingredient</title> <link rel="stylesheet" href="{{ asset('css/userform.css') }}">
</head> <body>
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
                            action="{{ route('ingredient.delete', ['recipe_id' => $recipe->recipe_id, 'ingredientId' => $item->ingredient_id]) }}"
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


        <form method="POST" action="{{ route('ingredients.store', ['recipe_id' => $recipe->recipe_id]) }}"
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

        @if (!$ingredient->isEmpty())
        <!-- Update Ingredient Form -->
        <div id="update-ingredient-form" style="display: none;">
            <h3>Update Ingredient</h3>
            <form method="POST"
                action="{{ route('ingredient.update', ['recipe_id' => $recipe->recipe_id, 'ingredientId' => $item->ingredient_id]) }}"
                id="update-ingredient-form">
                @method('PUT')
                @csrf
                <input type="text" name="ingredient_name" id="update-ingredient-name" placeholder="Ingredient Name" required>
                <input type="text" name="quantity" id="update-ingredient-quantity" placeholder="Quantity">
                <input type="text" name="size" id="update-ingredient-size" placeholder="Size" >
                <input type="text" name="note" id="update-ingredient-note" placeholder="Note" >
                <button id="ingredient-update" type="submit">Update Ingredient</button>
                <button type="button" id="cancel-update">Cancel</button>
            </form>
        </div>
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
            document.getElementById('update-ingredient-form').action = `/ingredientUser/{{ $recipe->recipe_id }}/updateIngredient/${ingredientId}`;
            document.getElementById('update-ingredient-name').value = ingredient.ingredient_name;
            document.getElementById('update-ingredient-quantity').value = ingredient.quantity;
            document.getElementById('update-ingredient-size').value = ingredient.size;
            document.getElementById('update-ingredient-note').value = ingredient.note;
            document.getElementById('update-ingredient-form').style.display = 'block';
        });
});

    // Cancel Update button click event
    document.getElementById('cancel-update').addEventListener('click', function () {
        document.getElementById('update-ingredient-form').style.display = 'none';
    });
</script>


</body>

</html>











////vseri 2
<!DOCTYPE html> <html lang="en"> <head> <meta charset="UTF-8"> <meta name="viewport" content="width=device-width,
    initial-scale=1.0"> <title>add ingredient</title> <link rel="stylesheet" href="{{ asset('css/userform.css') }}">
</head> <body>
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
                    <button type="button" class="edit-ingredient" data-bs-toggle="modal"
                        data-bs-target="#editIngredientModal{{ $item->id }}" data-ingredient-id="{{ $item->ingredient_id }}"
                        data-ingredient-name="{{ $item->ingredient_name }}" data-quantity="{{ $item->quantity }}"
                        data-size="{{ $item->size }}" data-note="{{ $item->note }}">
                        Edit
                    </button>
                    <form
                            action="{{ route('ingredient.delete', ['recipe_id' => $recipe->recipe_id, 'ingredientId' => $item->ingredient_id]) }}"
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

        <form method="POST" action="{{ route('ingredients.store', ['recipe_id' => $recipe->recipe_id]) }}"
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

    <!-- Modal for updating ingredient -->
    <div class="modal d-none" id="editIngredientModal{{ $item->id }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editIngredientModalLabel">Edit Ingredient {{$item->ingredient_name}}</h5>
                </div>
                <div class="modal-body">
                    <!-- Add your update form here -->
                    <form action="{{ route('ingredient.update', ['recipe_id' => $recipe->recipe_id, 'ingredientId' => $item->ingredient_id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <!-- Your form fields for updating ingredient -->
                        <label for="ingredient_name">Ingredient Name:</label>
                        <input type="text" name="ingredient_name" value="{{ $item->ingredient_name }}" required>

                        <label for="quantity">Quantity:</label>
                        <input type="text" name="quantity" value="{{ $item->quantity }}">

                        <label for="size">Size:</label>
                        <input type="text" name="size" value="{{ $item->size }}">

                        <label for="note">Note:</label>
                        <input type="text" name="note" value="{{ $item->note }}">

                        <button type="submit">Update Ingredient</button>
                        <button type="button" id="cancel-update">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
<script>
    document.querySelectorAll('.edit-ingredient').forEach(function (button) {
        button.addEventListener('click', function () {
            var modalId = this.getAttribute('data-bs-target');
            var modal = new bootstrap.Modal(document.querySelector(modalId));

            // Get the ingredient data
            var ingredientId = this.getAttribute('data-ingredient-id');
            var ingredientName = this.getAttribute('data-ingredient-name');
            var quantity = this.getAttribute('data-quantity');
            var size = this.getAttribute('data-size');
            var note = this.getAttribute('data-note');

            // Populate the form fields
            var form = document.querySelector(`${modalId} form`);
            form.querySelector('[name="ingredient_name"]').value = ingredientName;
            form.querySelector('[name="quantity"]').value = quantity;
            form.querySelector('[name="size"]').value = size;
            form.querySelector('[name="note"]').value = note;

            // Show the modal
            modal.show();

            // Handle the "Cancel" button
            var cancelButton = document.getElementById('cancel-update');
            cancelButton.addEventListener('click', function () {
                modal.hide(); // Close the modal without making any changes
            });
        });
    });
</script>


</body>

</html>



//step correct
<script>
@foreach ($steps as $step)
    document.querySelectorAll('.edit-step').forEach(function (button) {
    button.addEventListener('click', function () {
        var modalId = this.getAttribute('data-bs-target');
        var modal = new bootstrap.Modal(document.querySelector(modalId));
        
        // Get the step data
        var stepId = this.getAttribute('data-stepid');
        var stepOrder = this.getAttribute('data-step-order');
        var description = this.getAttribute('data-description');

        // Populate the form fields
        var form = document.querySelector(`${modalId} form`);
        form.querySelector('[name="step_order"]').value = stepOrder;
        form.querySelector('[name="description"]').value = description;

        // Update form action to include stepId
        form.action = "{{ route('update-step', ['id' => $recipe->recipe_id, 'stepId' => '__stepId__']) }}".replace('__stepId__', stepId);

        // Show the modal
        modal.show();

       // Handle the "Cancel" button
        var cancelButton = document.querySelector(`${modalId} .cancel-update`);
        cancelButton.addEventListener('click', function () {
            modal.hide(); // Close the modal without making any changes
        });
    });
});
@endforeach
</script>


@foreach ($steps as $step)
    <div class="modal custom-edit-step-modal d-none" id="editStepModal{{ $step->id }}" tabindex="-1" aria-labelledby="editStepModalLabel-{{ $step->id }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editStepModalLabel-{{ $step->id }}">Edit Step {{$step->step_order}}</h5>
                </div>

                <div class="modal-body">
                    <form action="{{ route('update-step', ['id' => $recipe->recipe_id, 'stepId' => $step->step_id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <label for="step_order">Step Order:</label>
                        <input type="text" name="step_order" value="{{ $step->step_order }}" required>
        
                        <label for="description">Description:</label>
                        <textarea name="description" required>{{ $step->description }}</textarea>
        
                        <button type="submit" class="btn btn-primary step-update">Update Step</button>
                        <button type="button" class="btn btn-secondary cancel-update">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach