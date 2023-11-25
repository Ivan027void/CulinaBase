<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/userDashboard.css') }}">
</head>
<body>

<div id="floating-area" class="floating-area">
        <a href="#top">Top</a> |
        <a href="#recipe">Recipe</a> 
    </div>

    <div class="container" >
        <header id="top">
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
            <div class="user-dashboard">
                @if (auth()->check())
                <h1>Welcome, {{ auth()->user()->name }}!</h1>
                @else
                <h1>Welcome, Guest!</h1>
                @endif
                <p>Manage your recipes and more.</p>

                <div class="dashboard-actions">
                    <form action="{{ route('form-user') }}" method="get">
                        @csrf
                        <button type="submit" class="btn new-recipe">Add New Recipe</button>
                    </form>
                </div>

                <div class="search-container">
            <label for="recipeSearch">Search:</label>
            <input type="text" id="recipeSearch" placeholder="Type to search...">
             <!-- Add Reset Filter button -->
            <button type="button" id="resetFilterBtn">Reset Filter</button>
        </div>

                <div class="recipe-list" id="recipe">
                    <h2>Your Recipes</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Recipe Name</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($userRecipes as $recipe)
                            <tr class="recipe-row">
                                <td  class="recipe-name">{{ $recipe->recipe_name }}</td>
                                <td>{{ Str::limit($recipe->description, 100, '...') }}</td> <!-- Add a category column if needed -->
                                <td>
                                <div class="button-container">
                                    <button onclick="window.location='/recipe_info/{{ $recipe->recipe_id }}'" class="btn-show">Show</button>
                                    <button onclick="window.location='{{ route('ingredient-user', $recipe->recipe_id) }}'"
                                        class="btn-add-ingredient">Add Ingredient</button>
                                    <button onclick="window.location='{{ route('step-user', $recipe->recipe_id) }}'" class="btn-langkah-memasak">Add
                                        Steps</button>
                                    <button onclick="window.location='{{ route('edit-recipe', $recipe->recipe_id) }}'" class="btn-edit">Edit</button>
                                </div>

                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3">No recipes yet. Add your first recipe!</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="extra-note">
                <div class="language-toggle">
                        <label for="language">Select Language:</label>
                        <select id="language" onchange="changeLanguage()">
                            <option value="en">English</option>
                            <option value="id">Bahasa Indonesia</option>
                        </select>
                    </div>
                    
                    <div class="delete-info" id="deleteInfo">
                        <h2>Deleting Recipes</h2>
                        <p id="deleteInfoText">
                            As of now, you do not have the ability to delete recipes directly. If you wish to remove a recipe,
                            please contact the website administrator for assistance. We appreciate your understanding and cooperation.
                        </p>
                    </div>
                </div>

                <div class="logout">
                    <form method="post" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn_logout" type="submit" class="btn btn-light button-link">Logout</button>
                    </form>
                </div>
            </div>
        </main>

        <footer>
            <div class="footerBox">
                <p>
                    Copyright &copy; CulinaBase Information System
                </p>
            </div>
        </footer>
    </div>

    <script>
            function changeLanguage() {
                const language = document.getElementById('language').value;

                // Update text content based on the selected language
                if (language === 'id') {
                    document.getElementById('deleteInfoText').innerText =
                        'Saat ini, Anda tidak memiliki kemampuan untuk menghapus resep secara langsung. Jika Anda ingin menghapus resep, ' +
                        'silakan hubungi administrator situs web untuk bantuan. Kami menghargai pengertian dan kerjasama Anda.';
                } else {
                    document.getElementById('deleteInfoText').innerText =
                        'As of now, you do not have the ability to delete recipes directly. If you wish to remove a recipe, ' +
                        'please contact the website administrator for assistance. We appreciate your understanding and cooperation.';
                }
            }
        </script>

<script>
    // Show or hide the floating area based on scroll position
    window.onscroll = function () {
        console.log('Scrolling...');
        scrollFunction();
    };

    function scrollFunction() {
        var floatingArea = document.querySelector(".floating-area");
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            console.log('Displaying floating area...');
            floatingArea.style.display = "block";
        } else {
            console.log('Hiding floating area...');
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
    $(document).ready(function () {
        // Handle keyup event on the search input
        $('#recipeSearch').on('input', function () {
            filterRecipes();
        });

        // Function to filter recipes based on search
        function filterRecipes() {
            var searchText = $('#recipeSearch').val().toLowerCase();

            $('.recipe-row').each(function () {
                var recipeName = $(this).find('.recipe-name').text().toLowerCase();
                
                var isSearchMatch = recipeName.includes(searchText);

                if (isSearchMatch) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }

        // Add click event to the Reset Filter button
        $('#resetFilterBtn').click(function () {
            // Clear the search input
            $('#recipeSearch').val('');
            // Trigger the filter function
            filterRecipes();
        });
    });
</script>

</body>
</html>
