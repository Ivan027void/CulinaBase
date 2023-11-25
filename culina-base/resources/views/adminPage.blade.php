<!DOCTYPE html> <html lang="en"> <head>
<meta charset="UTF-8"> <meta name="viewport" content="width=device-width, initial-scale=1.0"> <title>Admin Page</title>
<link rel="stylesheet" href="{{ asset('css/admin.css') }}"> 
</head> 
<body> 

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

<div id="floating-area" class="floating-area">
        <a href="#top">Top</a> |
        <a href="#user-management">User</a> |
        <a href="#recipe-management">Recipe</a> 
    </div>
    <div class='container' id="top"> 
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
                                <a href="#user-management">User</a>
                                <a href="#recipe-management">Recipe</a> 
                                @auth
                                <a href="/profile">{{Auth::user()->name }}</a>
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
                <th>Email</th>
                <th>Time Created</th>
            </tr>
            @if(isset($users))
                @foreach($users as $user)
                    <tr class="user-row" data-author="{{ $user->name }}">
                        <td class="user-name">{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>
                    </tr>
                @endforeach
            @else
                @foreach($dummyUsers as $dummyUser)
                    <tr>
                        <td>{{ $dummyUser['name'] }}</td>
                        <td>{{ $dummyUser['email'] }}</td>
                        <td>{{ $dummyUser['created_at'] }}</td>
                    </tr>
                @endforeach
            @endif
        </table>
    </section>

    <section id="recipe-management">
        <h2>Recipe Management</h2>
        <div class="dashboard-actions">
            <form action="{{ route('form-admin') }}" method="get">
                @csrf
                <button type="submit" class="btn new-recipe">Add New Recipe</button>
            </form>
        </div>

        <div class="search-container">
            <label for="recipeSearch">Search:</label>
            <input type="text" id="recipeSearch" placeholder="Type to search...">
        
            <label for="authorFilter">Filter by Author:</label>
            <select id="authorFilter">
                <option value="">All Authors</option>
                <!-- Add options dynamically based on available authors -->
            </select>
        
            <!-- Add Reset Filter button -->
            <button type="button" id="resetFilterBtn">Reset Filter</button>
        </div>


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
                <th>No</th>
                <th>Recipe Name</th>
                <th>Author</th>
                <th>Description</th>
                <th>aksi</th>
            </tr>
            @foreach($recipes as $recipe)
            <tr class="recipe-row">
                <td>{{ $loop->iteration }}</td>
                <td class="recipe-name">{{ $recipe->recipe_name }}</td>
                <td class="author-name">{{ $recipe->author->name ?? '-' }}</td>
                <td>{{ Str::limit($recipe->description, 100, '...') }}</td>
                <td>
                <div class="button-container">
                <button type="button" class="btn btn-custom-primary" onclick="window.location.href='{{ route('recipes.show', $recipe->recipe_id) }}'">Show</button>
                <button type="button" class="btn btn-custom-success" onclick="window.location.href='{{ route('recipes.edit', $recipe->recipe_id) }}'">Edit</button>
                <button type="button" class="btn btn-custom-danger" onclick="showDeleteConfirmationModal('{{ route('recipes.delete', $recipe->recipe_id) }}')">Delete</button>
            </div>
                </td>
            </tr>
            @endforeach
        </table>
        @endif
    </section>

    <div id="deleteConfirmationModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeDeleteConfirmationModal()">&times;</span>
        <p>Are you sure you want to delete this recipe?</p>
        <form id="deleteForm" method="POST" action="">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-custom-danger">Delete</button>
        </form>
    </div>
</div>


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
        // Populate the author dropdown dynamically
        var authors = [];
        $('.recipe-row').each(function () {
            var authorName = $(this).find('.author-name').text();
            if ($.inArray(authorName, authors) === -1) {
                authors.push(authorName);
                $('#authorFilter').append('<option value="' + authorName + '">' + authorName + '</option>');
            }
        });

        // Handle keyup event on the search input and change event on the author dropdown
        $('#recipeSearch, #authorFilter').on('input change', function () {
            filterRecipes();
        });

        // Add click event to user names
        $('.user-row').click(function () {
            var authorName = $(this).data('author');
            // Set the author filter input value
            $('#authorFilter').val(authorName);
            // Trigger the filter function
            filterRecipes();
        });

        // Function to filter recipes based on search and author filter
        function filterRecipes() {
            var searchText = $('#recipeSearch').val().toLowerCase();
            var selectedAuthor = $('#authorFilter').val().toLowerCase();

            $('.recipe-row').each(function () {
                var recipeName = $(this).find('.recipe-name').text().toLowerCase();
                var authorName = $(this).find('.author-name').text().toLowerCase();

                var isSearchMatch = recipeName.includes(searchText) || authorName.includes(searchText);
                var isAuthorMatch = selectedAuthor === '' || authorName === selectedAuthor;

                if (isSearchMatch && isAuthorMatch) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }

        // Add click event to the Reset Filter button
        $('#resetFilterBtn').click(function () {
            // Clear the search input and author filter
            $('#recipeSearch').val('');
            $('#authorFilter').val('');

            // Trigger the filter function
            filterRecipes();
        });
    });
</script>

<!-- Add this JavaScript code to handle modal interactions -->
<script>
    function showDeleteConfirmationModal(deleteUrl) {
        var modal = document.getElementById('deleteConfirmationModal');
        var deleteForm = document.getElementById('deleteForm');

        // Set the form action dynamically based on the deleteUrl
        deleteForm.action = deleteUrl;

        // Display the modal
        modal.style.display = 'block';
    }

    function closeDeleteConfirmationModal() {
        var modal = document.getElementById('deleteConfirmationModal');
        modal.style.display = 'none';
    }

    // Close the modal if the user clicks outside of it
    window.onclick = function (event) {
        var modal = document.getElementById('deleteConfirmationModal');
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    };
</script>







</body>

</html>