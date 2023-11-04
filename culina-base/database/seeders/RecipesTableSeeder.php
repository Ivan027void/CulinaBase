<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recipe;

class RecipesTableSeeder extends Seeder
{
    public function run()
    {
        // Recipe::create([
        //     'recipe_name' => 'Spaghetti Carbonara',
        //     'gambar' => 'carbonara.jpg',
        //     'description' => 'Spaghetti Carbonara adalah hidangan pasta klasik Italia yang terkenal dengan kelezatan dan kesederhanaannya. Hidangan ini terdiri dari spaghetti, saus krim yang dihasilkan dari campuran telur, keju parmesan, pancetta (atau guanciale), serta bawang putih. Hidangan ini memiliki cita rasa gurih, krimi, dan sedikit asin dari keju, serta tekstur yang khas dan menggoda. Spaghetti Carbonara biasanya dihiasi dengan parmesan tambahan dan lada hitam sebelum disajikan. Meskipun sederhana dalam bahan, ketika disajikan dengan baik, Spaghetti Carbonara adalah hidangan pasta yang sangat memuaskan dan menjadi favorit banyak orang di seluruh dunia.',
        //     'preparation_time' => 'sekitar 15-20 menit',
        //     'cooking_time' => 'sekitar 15 menit',
        // ]);
        // Recipe::create([
        //     'recipe_name' => 'Chicken Alfredo',
        //     'gambar' => 'Chicken_Alfredo.jpg',
        //     'description' => 'Chicken Alfredo adalah hidangan pasta yang kaya dan lezat yang terdiri dari potongan ayam, saus krim lembut, dan pasta, biasanya menggunakan fettuccine. Hidangan ini ditambahkan dengan bawang putih, keju parmesan, mentega, dan bahan-bahan lain yang memberikan cita rasa gurih dan krimi. Potongan ayam yang dimasak bersama dengan saus memberikan hidangan ini cita rasa berprotein dan gurih. Chicken Alfredo sering dihiasi dengan keju parmesan tambahan dan peterseli untuk hiasan. Ini adalah hidangan Italia yang terkenal di seluruh dunia karena kesederhanaan dan kelezatannya, sering kali menjadi pilihan favorit di restoran-restoran pasta dan merupakan hidangan yang populer di rumah juga.',
        //     'preparation_time' => 'sekitar 10-15 menit',
        //     'cooking_time' => 'sekitar 15-20 menit',
        // ]);
        // Recipe::create([
        //     'recipe_name'=>'Margherita Pizza',
        //     'gambar'=>'Margherita_Pizza.jpg',
        //     'description'=>'Margherita Pizza adalah hidangan pizza Italia yang sederhana, tetapi sangat lezat. Dalam hidangan ini, pizza disajikan dengan kulit tipis yang dilapisi dengan saus tomat, mozzarella parut, potongan tomat segar, dan daun basil. Ini adalah pizza klasik yang dikenal dengan cita rasa yang segar, gurih, dan sedikit pedas dari daun basil segar. Margherita Pizza adalah contoh sempurna dari keindahan dalam kesederhanaan, dengan bahan-bahan berkualitas yang mendominasi. Itu adalah hidangan yang populer di seluruh dunia dan sering dihargai karena rasa autentisnya dalam menjunjung cita rasa Italia yang klasik dan segar.',
        //     'preparation_time'=>'sekitar 30 menit',
        //     'cooking_time'=>'sekitar 12-15 menit'
        // ]);
        // Recipe::create([
        //     'recipe_name'=>'Beef Stir-Fry',
        //     'gambar'=>'Beef-Stir-Fry.jpg',
        //     'description'=>'Beef Stir-Fry adalah hidangan yang menggugah selera yang terdiri dari potongan daging sapi yang dipotong tipis, yang kemudian dimasak dengan berbagai jenis sayuran segar dalam saus gurih dan aromatik. Potongan daging sapi sering kali dibumbui dan dimarinasi untuk meningkatkan rasa gurih dan manisnya.',
        //     'preparation_time'=>'sekitar 15-20 menit.',
        //     'cooking_time'=>'sekitar 10-15 menit.'
        // ]);
        // Recipe::create([
        //     'recipe_name'=>'Caesar Salad',
        //     'gambar'=>'Ceasar-Salad.jpg',
        //     'description'=>'Caesar Salad adalah hidangan salad klasik yang terdiri dari daun romaine lettuce yang dirobek menjadi potongan-potongan kecil, saus dressing yang khas, parmesan parut, dan crouton (potongan roti yang dibakar). Dressing Caesar Salad biasanya terbuat dari campuran bawang putih, mayones, jus lemon, anchovy, dan parmesan. Hidangan ini sering dihias dengan irisan daging ayam panggang atau udang, tetapi variasi lain juga umum. Caesar Salad adalah hidangan yang terkenal karena rasa krimi dan gurih dressingnya yang khas, serta tekstur yang kontras antara daun selada yang segar dan crouton yang renyah. Hidangan ini adalah hidangan pembuka yang populer di restoran-restoran dan sering disajikan dalam porsi utama dengan penambahan protein tambahan seperti ayam, udang, atau daging lainnya. Caesar Salad merupakan salah satu hidangan salad yang paling dikenal di seluruh dunia.',
        //     'preparation_time'=>'sekitar 15-20 menit.',
        //     'cooking_time'=>'sekitar 10-15 menit'
        // ]);
        // Recipe::create([
        //     'recipe_name'=>'Mango Smoothie',
        //     'gambar'=>'Mango_Smoothie.jpeg',
        //     'description'=>'Mango Smoothie adalah minuman segar yang terbuat dari campuran mangga yang telah dibekukan, yogurt alami atau jus jeruk, dan kadang-kadang gula atau pemanis lainnya, tergantung pada selera. Minuman ini memiliki rasa manis dan krimi dari mangga, serta tekstur yang lembut dan dingin. Mango Smoothie adalah minuman yang seringkali disajikan sebagai camilan sehat atau sarapan yang lezat, dan biasanya dihiasi dengan potongan mangga atau irisan jeruk sebagai hiasan. Minuman ini populer di seluruh dunia karena kesegarannya, khususnya di daerah-daerah yang mangga mudah ditemukan.',
        //     'preparation_time'=>'sekitar 5-10 menit.',
        //     'cooking_time'=>'sekitar 2-5 menit'
        // ]);
        // Recipe::create([
        //     'recipe_name'=>'Grilled Salmon',
        //     'gambar'=>'Grilled_Salmon.jpeg',
        //     'description'=>'Grilled Salmon adalah hidangan yang terdiri dari potongan salmon yang dimasak di atas panggangan dengan panas langsung. Salmon sering kali dimarinasi atau dibumbui dengan rempah-rempah dan bumbu, lalu dipanggang hingga matang dan memiliki permukaan yang garing sementara dagingnya tetap lembut dan berair. Salmon panggang biasanya disajikan dengan bumbu pelengkap seperti saus lemon, bawang putih, atau herbs. Hidangan ini dikenal karena rasa daging salmon yang khas, dengan tekstur yang menggoda dan cita rasa gurih yang enak. Grilled Salmon adalah hidangan yang kaya protein dan sehat yang sering disajikan di restoran dan di rumah sebagai hidangan utama yang lezat.',
        //     'preparation_time'=>'sekitar 10-15 menit',
        //     'cooking_time'=>'sekitar 10-15 menit.'
        // ]);
        Recipe::create([
            'recipe_name'=>'Vegetable Curry',
            'gambar'=>'Vegetable_Curry.jpg',
            'description'=>'Vegetable Curry adalah hidangan kari yang terdiri dari berbagai sayuran yang dimasak dalam saus rempah-rempah berbasis kari yang kaya rasa. Sayuran seperti kentang, wortel, kacang panjang, dan buncis sering digunakan dalam hidangan ini, tetapi bisa disesuaikan dengan preferensi. Saus kari terbuat dari campuran bumbu rempah seperti kunyit, jintan, dan lada, yang memberikan cita rasa pedas, gurih, dan aromatik. Hidangan ini sering disajikan dengan nasi atau roti, seperti naan, untuk menyerap sausnya yang kaya. Vegetable Curry adalah hidangan yang nikmat, sehat, dan penuh rasa yang populer dalam masakan India dan berbagai masakan dunia.',
            'preparation_time'=>'sekitar 10-15 menit.',
            'cooking_time'=>'sekitar 20-25 menit'
        ]);
        Recipe::create([
            'recipe_name'=>'Chocolate Brownies',
            'gambar'=>'Chocolate_Brownies.jpeg',
            'description'=>'Chocolate Brownies adalah makanan pencuci mulut yang populer yang terdiri dari sepotong kue yang padat, berwarna cokelat gelap, dan teksturnya lembut dengan lapisan kerak renyah di atasnya. Brownies ini diperkaya dengan rasa cokelat yang kaya dan manis, seringkali dengan tambahan potongan cokelat atau kacang-kacangan yang memberikan sedikit gigitan ekstra. Ini adalah hidangan yang sangat nikmat, terutama bagi para pecinta cokelat, dan sering disajikan sebagai camilan atau pencuci mulut dengan krim es krim atau saus cokelat. Chocolate Brownies adalah hidangan yang sering disukai di seluruh dunia karena kelezatannya yang khas.',
            'preparation_time'=>'sekitar 15-20 menit',
            'cooking_time'=>'sekitar 20-25 menit'
        ]);


    }
} //php artisan db:seed --class=RecipesTableSeeder



