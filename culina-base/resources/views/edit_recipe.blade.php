<!DOCTYPE html> 
<html lang="en">
     <head> 
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>Resep {{ $recipe->recipe_name }}</title>
        <link rel="stylesheet" href="{{ asset('css/resep.css') }}">
    </head> 
    <body> 
        <div Class='Container'>
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
                <img src="{{ asset('recipe/' . $recipe->gambar) }}" alt="{{ $recipe->recipe_name }}">
                <h1>{{ $recipe->recipe_name }}</h1>
                <p>Penulis: {{ $recipe->author ? $recipe->author->name : '-' }}</p>
                <h2>Deskripsi</h2>
                <p>{{$recipe->description }}</p>
                <p>Waktu Persiapan: {{ $recipe->preparation_time }}</p>
                <p>Waktu Memasak: {{ $recipe->cooking_time }}</p>

                <h3>Bahan-bahan:</h3>
                <ul>
                    @foreach ($ingredients as $ingredient)
                        <li>{{ $ingredient->quantity }} {{ $ingredient->size }} {{ $ingredient->ingredient_name }} {{ $ingredient->note }}</li>
                    @endforeach
                </ul>


                <h3>Cara Memasak:</h3>
                <ol type="1">
                    @foreach ($recipe->steps as $step)
                    <li>{{ $step->description }}</li>
                    @endforeach
                </ol>

                <button class="btn_kembali" onclick="history.back()">Back</button>
            </main>
            
            <footer>
                <div class="footerBox">
                    <p>Copyright &copy; CulinaBase kelompok Sistem Informasi</p>
                </div>
            </footer>
        </div>
    </body>
</html>