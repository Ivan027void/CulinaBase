@include('sweetalert::alert')
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
                                <button type="button" class="edit-step" data-stepid="{{ $step->id }}">Edit</button>
                                <form action="{{ route('delete-step', ['id'=> $recipe->recipe_id, 'stepId' => $step->step_id]) }}" method="POST"
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
            <form method="POST" action="{{ route('add-step', $recipe->recipe_id) }}">
                @csrf
                <label for="description">Add Step:</label>
                <input type="text" name="step_order" placeholder="Step Order" required>
                <input type="text" name="description" placeholder="Description" required>
                <button type="submit">Add Step</button>
            </form>

            <!-- Update Step Form -->
            <div id="update-step-form" style="display: none;">
                <h3>Update Step</h3>
                <form method="POST" action="{{ route('update-step', ['id' => $recipe->recipe_id, 'stepId' => $step->step_id]) }}" id="update-step-form">
                    @method('PUT')
                    @csrf
                    <input type="text" name="step_order" id="update-step-order" placeholder="Step Order" required>
                    <input type="text" name="description" id="update-step-description" placeholder="Description" required>
                    <button id="step-update" type="submit">Update Step</button>
                    <button type="button" id="cancel-update">Cancel</button>
                </form>
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
    // Add your JavaScript code here

    // Edit Step button click event
    document.querySelectorAll('.edit-step').forEach(function (button) {
        button.addEventListener('click', function () {
            // Fetch the step details and populate the update form
            let stepId = button.getAttribute('data-stepid');
            let step = {!! json_encode($steps->keyBy('id')->toArray(), JSON_HEX_TAG) !!}[stepId];
            document.getElementById('update-step-form').action = `/stepUser/{{ $recipe->recipe_id }}/updateStep/${stepId}`;
            document.getElementById('update-step-order').value = step.step_order;
            document.getElementById('update-step-description').value = step.description;
            document.getElementById('update-step-form').style.display = 'block';
        });
    });

    // Cancel Update button click event
    document.getElementById('cancel-update').addEventListener('click', function () {
        document.getElementById('update-step-form').style.display = 'none';
    });

    </script>
</body>

</html>


</body>

</html>