<!DOCTYPE html> <html lang="en"> <head> <meta charset="UTF-8"> <meta name="viewport" content="width=device-width,
    initial-scale=1.0"> <title>Upload Recipe</title> <link rel="stylesheet" href="{{ asset('css/userform.css') }}">
    </head>

<body>
    <div class='container'> <header> <div class="navContainer">
        <nav>
            <ul id="navList">
                <li> <a id="navLogo" href="/">CulinaBase</a> </li>
                <li? <div id="navItems"> <a href="/">Home</a>
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
            </nav> </div> </header>

            <main>

                <h2 class="recipe_title">{{ $recipe->recipe_name }}</h2> <p>{{ $recipe->description }}</p> <h3>Langkah
                Memasak:</h3> @if ($step->isEmpty())
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
                    @foreach ($step as $item)
                    <tr>
                        <td>{{ $item->step_order }}</td>
                        <td>{{ $item->description }}</td>
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

                <form method="POST" action="{{ route('steps.store', ['recipe_id' => $recipe->recipe_id]) }}"
                    enctype="multipart/form-data">
                    @csrf
                    <label for="descriptions">Steps:</label>
                    <div id="step_descriptions-container">
                        <div class="step-row">
                            <input type="text" name="descriptions[]" class="step-description-input"
                                placeholder="Deskripsi Langkah" required>
                            <button type="button" class="remove-step">Remove</button>
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


                <script>
                    document.getElementById('add-step').addEventListener('click', function () {
                        const stepInput = document.createElement('div');
                        stepInput.className = 'step-row';
                        stepInput.innerHTML = `
                        <input type="text" name="step_descriptions[]" class="step-description-input" placeholder="Deskripsi Langkah" required>
                        <button type="button" class="remove-step">Remove</button>`;
                        document.getElementById('step_descriptions-container').appendChild(stepInput);
                    });

                    document.getElementById('step_descriptions-container').addEventListener('click', function (e) {
                        if (e.target.classList.contains('remove-step')) {
                            e.target.parentElement.remove();
                        }
                    });
                </script>


            </main>

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