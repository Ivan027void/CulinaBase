<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Recipe</title>
    <link rel="stylesheet" href="{{ asset('css/userform.css') }}">
</head>

<body>
    <div class='container'>
        <header>
            <div class="navContainer">
                <nav>
                    <ul id="navList">
                        <li> <a id="navLogo" href="/">CulinaBase</a> </li>
                        <li>
                            <div id="navItems">
                                <a href="/">Home</a>
                                @auth
                                <a href="/profile">{{ Auth::user()->name }}</a>
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
            <p>{{ $recipe->description }}</p>
            <h3>Langkah Memasak:</h3>

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
                            <button  data-bs-toggle="modal" data-bs-target="#deleteModal" id="delete-step">Delete</button>
                            </div>
                        </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif

            <!-- Add Step Form -->
            <form method="POST" action="{{ route('add-step', $recipe->recipe_id) }}">
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

                var formAction = "{{ route('update-step', ['id' => $recipe->recipe_id, 'stepId' => ':stepId']) }}";
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

<!-- Add this to the head of your HTML file -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ZGlB5kF9Fhzz5lSkZFREudufGA6dtFVeCpJ/yPPGe6XcWxRKKuUpo8h2zDPJJbo" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-oE4KeaWOTf1c5gOpScb/H5uL5zQ62nvNM/NEy+g3FzsPpUn1J6sD89HyaLXIbVo" crossorigin="anonymous"></script>


<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this step?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancel_delete">Cancel</button>
                <form action="{{ route('delete-step', ['id'=> $recipe->recipe_id, 'stepId' => $step->step_id]) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" id="delete-ingredient">Delete</button>
                </form>
            </div>
        </div>
    </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>