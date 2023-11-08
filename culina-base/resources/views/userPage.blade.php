<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/userDashboard.css') }}">
</head>
<body>
    <div class="container">
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
                                <a href="/">{{ Auth::user()->name }}</a>
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
            <div class="user-dashboard">
                @if (auth()->check())
                <h1>Welcome, {{ auth()->user()->name }}!</h1>
                @else
                <h1>Welcome, Guest!</h1>
                @endif
                <p>Manage your recipes and more.</p>

                <div class="dashboard-actions">
                    <a href="{{ route('form-user') }}" class="btn btn-primary">Add New Recipe</a>
                </div>

                <div class="recipe-list">
                    <h2>Your Recipes</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Recipe Name</th>
                                <th>Category</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($userRecipes as $recipe)
                            <tr>
                                <td>{{ $recipe->recipe_name }}</td>
                                <td>Main Dish</td> <!-- Add a category column if needed -->
                                <td>
                                    <a href="{{ route('ingredient-user', $recipe->recipe_id) }}" class="btn btn-success">Add Ingredient</a>
                                    <a href="{{ route('step-user', $recipe->recipe_id) }}" class="btn btn-info">Edit Steps</a>
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
                    Copyright &copy; CulinaBase kelompok Sistem Informasi
                </p>
            </div>
        </footer>
    </div>
</body>
</html>