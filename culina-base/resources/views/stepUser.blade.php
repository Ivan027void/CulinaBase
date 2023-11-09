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

             <h3>Langkah Memasak:</h3>

            @if ($step->isEmpty())
                <p>No step.</p>
            @else
                <table>
                    <thead>
                        <tr>
                            <th>no</th>
                            <th>description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($steps as $item)
                            <tr>
                                <td>{{ $item->step_order }}</td>
                                <td>{{ $item->description }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            <form method="POST" action="{{ route('step.add', ['recipe_id' => $recipe->recipe_id]) }}" enctype="multipart/form-data">
                @csrf
                <label for="steps">Steps:</label>
                <div id="steps-container">
                    <div class="steps-row">
                        <textarea name="steps[]" class="step-input" rows="4" placeholder="Enter Step Description" required></textarea>
                        <button type="button" class="remove-step">Remove Step</button>
                    </div>
                </div>
                <div class="button-container">
                    <div class="button-row-1">
                        <button type="button" id="add-step">Add Step</button>
                        <button type="submit">Submit Steps</button>
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

        document.getElementById('add-step').addEventListener('click', function () {
            // Create a new step input element
            const stepInput = document.createElement('div');
            stepInput.className = 'step-row';

            // Set the innerHTML of the step input element
            stepInput.innerHTML = `
                <textarea name="steps[]" class="step-input" rows="4" placeholder="Enter Step Description" required></textarea>
                <button type="button" class="remove-step">Remove</button>
            `;

            // Append the step input element to the steps container
            document.getElementById('steps-container').appendChild(stepInput);
        });

        document.getElementById('steps-container').addEventListener('click', function (e) {
            // Check if the clicked element is a 'remove-step' button
            if (e.target.classList.contains('remove-step')) {
                // Remove the parent element of the clicked button (step input row)
                e.target.parentElement.remove();
            }
        });

    </script>

</body>

</html>