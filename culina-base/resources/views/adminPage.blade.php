<!DOCTYPE html> <html lang="en"> <head>
<meta charset="UTF-8"> <meta name="viewport" content="width=device-width, initial-scale=1.0"> <title>Admin Page</title>
<link rel="stylesheet" href="css/admin.css"> </head> <body> <div class='container'> <header>
<div class="navContainer">
<nav>
<ul id="navList">
    <li>
    <a id="navLogo" href="/">CulinaBase</a>
    </li>
    <li>
    <div id="navItems">
    <a href="/">Home</a>
    <a href="#user-management">User Management</a>
    <a href="#recipe-management">Recipe Management</a>
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
    <section id="user-management">
        <h2>User Management</h2>
        <table>
            <tr>
                <th>User Name</th>
                <th>Time Created</th>
            </tr>
            <tr>
                <td>User 1</td>
                <td>2023-01-15 10:30:00</td>
            </tr>
            <tr>
                <td>User 2</td>
                <td>2023-02-20 14:45:00</td>
            </tr>
            <tr>
                <td>User 3</td>
                <td>2023-03-25 09:15:00</td>
            </tr>
            <tr>
                <td>User 4</td>
                <td>2023-04-10 12:00:00</td>
            </tr>
            <tr>
                <td>User 5</td>
                <td>2023-05-05 16:20:00</td>
            </tr>
        </table>
    </section>

    <section id="recipe-management">
        <h2>Recipe Management</h2>
        @if($recipes->isEmpty())
        <table>
            <tr>
                <th>Recipe ID</th>
                <th>Recipe Name</th>
                <th>Description</th>
            </tr>
            <tr>
                <td>1</td>
                <td>Recipe 1</td>
                <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Recipe 2</td>
                <td>Suspendisse in tristique nulla. In ac nisl a leo tristique.</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Recipe 3</td>
                <td>Ut fringilla ex a tristique. Nunc facilisis vestibulum felis.</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Recipe 4</td>
                <td>Vivamus a sem ut sapien tincidunt eleifend.</td>
            </tr>
            <tr>
                <td>5</td>
                <td>Recipe 5</td>
                <td>Phasellus auctor justo a ligula congue, eget efficitur dolor dapibus.</td>
            </tr>
            <!-- Add more dummy data rows as needed -->
        </table>
        @else
        <table>
            <tr>
                <th>Recipe ID</th>
                <th>Recipe Name</th>
                <th>Description</th>
                <th>aksi</th>
            </tr>
            @foreach($recipes as $recipe)
            <tr>
                <td>{{ $recipe->recipe_id }}</td>
                <td>{{ $recipe->recipe_name }}</td>
                <td>{{ Str::limit($recipe->description, 200, '...') }}</td>
                <td>
                    <form action="{{ route('recipes.show', $recipe->recipe_id) }}" method="GET" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-custom-primary">Show</button>
                    </form>
                    <form action="{{ route('recipes.edit', $recipe->recipe_id) }}" method="GET" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-custom-success">Edit</button>
                    </form>
                    <form action="{{ route('recipes.delete', $recipe->recipe_id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-custom-danger" onclick="return confirm('Are you sure you want to delete this recipe?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        @endif
    </section>


    <div class="logout">
        <form method="post" action="{{ route('logout') }}">
            @csrf
            <button class="btn_logout" type="submit" class="btn btn-light button-link">Logout</button>
        </form>
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