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
            <form method="POST" action="#" enctype="#">
                @csrf
                <label for="steps">Steps:</label>
                <div id="steps-container">
                    <div class="step-row">
                        <textarea name="steps[]" class="step-input" rows="4" required></textarea>
                        <button type="button" class="remove-step">Remove</button>
                    </div>
                </div>
                <button type="button" id="add-step">Add Step</button>


                <button type="submit">input langkah </button>
            </form>


            <button class="btn_kembali" onclick="history.back()">Back</button>
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
            const stepInput = document.createElement('div');
            stepInput.className = 'step-row';
            stepInput.innerHTML = `
                <textarea name="steps[]" class="step-input" rows="4" required></textarea>
                <button type="button" class="remove-step">Remove</button>
            `;
            document.getElementById('steps-container').appendChild(stepInput);
        });


        document.getElementById('steps-container').addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-step')) {
                e.target.parentElement.remove();
            }
        });
    </script>

</body>

</html>