<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Creditos'],
            ['name' => 'Convenios'],
            ['name' => 'Noticias y eventos'],
            ['name' => 'Otros']
        ];
        $c_model = new Category();
        foreach ($categories as $key => $category) {
            $c_model->save($category);
        }
    }
}
