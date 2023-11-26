<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CulinaBase - About Us</title>
    <link rel="stylesheet" href="css/aboutus.css">
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
                                <a href="/option">Recipe</a>
                                <a href="/about">About</a>
                                @auth
                                    @if (Auth::user()->isAdmin())
                                        <a href="/adminPage">{{ Auth::user()->name }}</a>
                                    @else
                                        <a href="/userPage">{{ Auth::user()->name }}</a>
                                    @endif
                                @else
                                    <a href="/login">Login</a>
                                @endauth
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>

        <main>
            <div class="contentBox">
                <section class="description">
                    <h1>About CulinaBase</h1>
                    <p>
                        Welcome to CulinaBase, your go-to platform for a collection of recipes from various sources.
                        We offer a diverse range of recipes, spanning from Indonesian to international cuisines, and even
                        vegetarian dishes.
                    </p>
                    <p>
                        Our goal is to make it easy for culinary enthusiasts to discover the recipes they are looking
                        for. We also aim to share information and cooking tips with our readers.
                    </p>
                </section>

                <section class="informasi">
                    <h2>For Your Information</h2>
                    <p>
                        We are a team comprising chefs, software developers, designers, and nutrition enthusiasts. With
                        diverse backgrounds, we share a common goal: to help people find joy in cooking and sharing
                        food.
                    </p>
                    <p>
                        We believe that cooking is an incredible way to connect with culture, share special moments, and
                        take care of ourselves and our loved ones. Our vision is to make cooking easier, more creative,
                        and more meaningful for everyone.
                    </p>
                    <p>
                        Our mission is to establish CulinaBase as the premier platform for culinary enthusiasts
                        worldwide. We strive to provide high-quality recipes, easy-to-follow guides, and useful tools to
                        help you succeed in the kitchen. We also aim to build a strong community around this shared
                        passion.
                    </p>
                    <p>
                        We uphold core values:
                    </p>
                    <ul class='point'>
                        <li><strong>Innovation:</strong> We constantly seek new ways to improve our service and make
                            it better.</li>
                        <li><strong>Quality:</strong> We are committed to providing the best content, tested recipes,
                            and accurate information.</li>
                        <li><strong>Openness:</strong> We value your feedback and are always ready to engage with you.
                        </li>
                        <li><strong>Customer Satisfaction:</strong> Your satisfaction is our top priority.</li>
                    </ul>
                </section>

                <section class="team">
                    <h2>Our Team</h2>
                    <div class="team-card">
                        <div class="card">
                            <img src="gambar/siluet.png" alt="Photo of Team Member 1">
                            <h3>Ivan Chiari</h3>
                            <p>Role or Position of Team Member 1</p>
                            <p>Brief description of Team Member 1.</p>
                        </div>
                        <div class="card">
                            <img src="gambar/siluet.png" alt="Photo of Team Member 2">
                            <h3>Wilda Fahera</h3>
                            <p>Role or Position of Team Member 2</p>
                            <p>Brief description of Team Member 2.</p>
                        </div>
                        <div class="card">
                            <img src="gambar/siluet.png" alt="Photo of Team Member 3">
                            <h3>Muhammad Raihan</h3>
                            <p>Role or Position of Team Member 3</p>
                            <p>Brief description of Team Member 3.</p>
                        </div>
                        <div class="card">
                            <img src="gambar/siluet.png" alt="Photo of Team Member 4">
                            <h3> Sri Azizah Nazhifah, S.Kom., M.Sc</h3>
                            <p>Dosen Pengampu Mata Kuliah </p>
                            <p>Brief description of Team Member 4.</p>
                        </div>
                        <!-- Repeat for other team members -->
                    </div>
                </section>

                <section class="contact">
                    <h2>Contact Us</h2>
                    <div class="card">
                        <ul>
                            <li><strong><img src="gambar/mapgoogle.jpeg" alt="Google Maps">Address:</strong>
                                <p>Jl. Jendral Sudirman No. 100, Jakarta Selatan</p>
                            </li>
                            <li><strong><img src="gambar/wa.jpeg" alt="WhatsApp">081234567890</strong></li>
                            <li><strong><img src="gambar/igLogo.jpg" alt="Instagram">@website_kumpulan_resep</strong>
                            </li>
                            <li><strong><img src="gambar/fb.png" alt="Facebook">Website Kumpulan Resep</strong></li>
                        </ul>
                    </div>
                </section>
            </div>
            <footer>
                <div class="footerBox">
                    <p>
                        Copyright &copy;CulinaBase Sistem Informasi
                    </p>
                </div>
            </footer>
        </main>
    </div>
</body>

</html>
