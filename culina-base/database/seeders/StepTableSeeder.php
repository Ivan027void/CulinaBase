<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Step;

class StepTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        step::create([
            'recipe_id'=> 1,
            'step_order'=>1,
            'description'=>'Didihkan air dalam panci besar, tambahkan sedikit garam, dan masak spaghetti sesuai petunjuk kemasan hingga al dente. Simpan sekitar 1/2 cangkir air rebusan pasta sebelum mengeringkannya.'
        ]);
        step::create([
            'recipe_id'=> 1,
            'step_order'=>2,
            'description'=>'Sementara spaghetti dimasak, panaskan sedikit minyak zaitun dalam wajan besar dan tumis potongan pancetta atau guanciale hingga menjadi renyah. Tambahkan bawang putih cincang, aduk-aduk, dan masak hingga harum. Matikan api.'
        ]);
        step::create([
            'recipe_id'=> 1,
            'step_order'=>3,
            'description'=>'Dalam mangkuk terpisah, kocok telur, parmesan, dan pecorino romano hingga rata. Tambahkan lada hitam secukupnya. Pastikan untuk mengocok bahan ini dengan cepat sehingga telur tidak membeku.'
        ]);
        step::create([
            'recipe_id'=> 1,
            'step_order'=>4,
            'description'=>'Setelah spaghetti matang, tiriskan dan segera masukkan ke dalam wajan dengan pancetta atau guanciale yang telah dimasak. Aduk rata agar pasta tercampur dengan rasa dan minyak yang ada di wajan.'
        ]);
        step::create([
            'recipe_id'=> 1,
            'step_order'=>5,
            'description'=>'Segera setelah itu, tuangkan campuran telur dan keju ke dalam wajan. Aduk cepat agar telur tidak membeku, dan tambahkan beberapa sendok air rebusan pasta yang telah Anda simpan untuk menciptakan saus yang kental dan lembut.'
        ]);
        step::create([
            'recipe_id'=> 1,
            'step_order'=>6,
            'description'=>'Sajikan Spaghetti Carbonara panas dan taburi dengan sedikit keju parmesan tambahan jika diinginkan.'
        ]);
       
    }//php artisan db:seed --class=StepTableSeeder
}
