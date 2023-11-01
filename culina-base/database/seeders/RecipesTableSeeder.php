<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recipe;

class RecipesTableSeeder extends Seeder
{
    public function run()
    {
        Recipe::create([
            'recipe_name' => 'Spaghetti Carbonara',
            'gambar' => 'carbonara.jpg',
            'description' => 'Spaghetti Carbonara adalah hidangan pasta klasik Italia yang terkenal dengan kelezatan dan kesederhanaannya. Hidangan ini terdiri dari spaghetti, saus krim yang dihasilkan dari campuran telur, keju parmesan, pancetta (atau guanciale), serta bawang putih. Hidangan ini memiliki cita rasa gurih, krimi, dan sedikit asin dari keju, serta tekstur yang khas dan menggoda. Spaghetti Carbonara biasanya dihiasi dengan parmesan tambahan dan lada hitam sebelum disajikan. Meskipun sederhana dalam bahan, ketika disajikan dengan baik, Spaghetti Carbonara adalah hidangan pasta yang sangat memuaskan dan menjadi favorit banyak orang di seluruh dunia.',
            'preparation_time' => 'sekitar 15-20 menit',
            'cooking_time' => 'sekitar 15 menit',
        ]);
        Recipe::create([
            'recipe_name' => 'Chicken Alfredo',
            'gambar' => 'Chicken_Alfredo.jpg',
            'description' => 'Chicken Alfredo adalah hidangan pasta yang kaya dan lezat yang terdiri dari potongan ayam, saus krim lembut, dan pasta, biasanya menggunakan fettuccine. Hidangan ini ditambahkan dengan bawang putih, keju parmesan, mentega, dan bahan-bahan lain yang memberikan cita rasa gurih dan krimi. Potongan ayam yang dimasak bersama dengan saus memberikan hidangan ini cita rasa berprotein dan gurih. Chicken Alfredo sering dihiasi dengan keju parmesan tambahan dan peterseli untuk hiasan. Ini adalah hidangan Italia yang terkenal di seluruh dunia karena kesederhanaan dan kelezatannya, sering kali menjadi pilihan favorit di restoran-restoran pasta dan merupakan hidangan yang populer di rumah juga.',
            'preparation_time' => 'sekitar 10-15 menit',
            'cooking_time' => 'sekitar 15-20 menit',
        ]);

    }
} //php artisan db:seed --class=RecipesTableSeeder


