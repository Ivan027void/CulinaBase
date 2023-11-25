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

        @if ($errors->any())
        <div class="warning">
            <p>Please fix the errors in the form and try again.</p>
            <p>Please fill in all required fields marked with <span class="required">*</span></p>
        </div>
        @endif

        <br>
        <hr>


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
                    <button type="button" class="edit-ingredient" data-bs-toggle="modal"
                        data-bs-target="#editIngredientModal{{ $item->ingredient_id }}" data-ingredient-id="{{ $item->ingredient_id }}"
                        data-ingredient-name="{{ $item->ingredient_name }}" data-quantity="{{ $item->quantity }}"
                        data-size="{{ $item->size }}" data-note="{{ $item->note }}">
                        Edit
                    </button>
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

        @foreach ($ingredient as $item)
                    <!-- Modal for updating ingredient -->
    <div class="modal d-none" id="editIngredientModal{{ $item->ingredient_id }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editIngredientModalLabel">Edit Ingredient {{$item->ingredient_name}}</h5>
                </div>
                <div class="modal-body">
                    <!-- Add your update form here -->
                    <form action="{{ route('ingredients.update', ['recipe_id' => $recipe->recipe_id, 'ingredientId' => $item->ingredient_id]) }}" method="POST">
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

                        <button type="submit" class="btn btn-primary">Update Ingredient</button>
                        <button type="button" id="cancel-update">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach


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

            <br>
            <hr>

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
                            <button type="button" class="edit-step" data-step-id="{{ $step->step_id }}">Edit</button>
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

                    <!-- Edit Step Modal -->
                    <div id="editStepModal" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2 class="modal-title">Edit Step Order</h2>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="editStepForm" method="POST" action="">
                                        @csrf
                                        @method('PUT')
                                        <label for="editStepOrder">Step Order:</label>
                                        <input type="text" name="step_order" id="editStepOrder" required>
                                        <label for="editStepDescription">Description:</label>
                                        <textarea name="description" id="editStepDescription" required></textarea>
                                        <!-- Changed to textarea -->
                                        <div class="button-container">
                                            <div class="button-row-1">
                                                <button type="submit" class="btn btn-primary">Update Step</button>
                                                <button type="button" class="btn btn-secondary" id="cancel-update"
                                                    data-bs-dismiss="modal">Cancel</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var modal = new bootstrap.Modal(document.getElementById('editStepModal'));
        var editButtons = document.querySelectorAll('.edit-step');

        editButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var stepOrder = this.closest('tr').querySelector('td:nth-child(1)').innerText;
                var stepDescription = this.closest('tr').querySelector('td:nth-child(2)').innerText;

                // Use dataset to access data-step-id attribute
                var stepId = this.dataset.stepId;

                var formAction = "{{ route('steps.update', ['id' => $recipe->recipe_id, 'stepId' => ':stepId']) }}";
                formAction = formAction.replace(':stepId', stepId);

                document.getElementById('editStepForm').action = formAction;
                document.getElementById('editStepOrder').value = stepOrder;
                document.getElementById('editStepDescription').value = stepDescription;

                // Set the modal title dynamically
                var modalTitle = document.querySelector('.modal-title');
                modalTitle.innerText = 'Edit Step Order - Step ID: ' + stepId + ', Order: ' + stepOrder;

                modal.show();
            });
        });

        document.getElementById('editStepForm').addEventListener('submit', function (event) {
            var confirmUpdate = confirm('Are you sure you want to update this step?');
            if (!confirmUpdate) {
                event.preventDefault(); // Cancel the form submission
            }
        });
    });
</script>

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

    @foreach($ingredient as $item)
    var modalId = '#editIngredientModal{{ $item->ingredient_id }}';
    var modal = new bootstrap.Modal(document.querySelector(modalId));

    // Select the "Cancel" button within the modal and attach the event listener
    var cancelButton = document.querySelector(`${modalId} .cancel-update`);
    cancelButton.addEventListener('click', function () {
        modal.hide(); // Close the modal without making any changes
    });

    document.getElementById('edit-ingredient{{ $item->ingredient_id }}').addEventListener('click', function () {
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
    });
    @endforeach
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