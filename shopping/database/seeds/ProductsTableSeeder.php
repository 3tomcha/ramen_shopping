<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $ramens = [
            ['name' => '塩ラーメン', 'price' => '500'],
            ['name' => '味噌ラーメン', 'price' => '600'],
            ['name' => '醤油ラーメン', 'price' => '600'],
            ['name' => '台湾ラーメン', 'price' => '700'],
            ['name' => '五目ラーメン', 'price' => '700'],
            ['name' => '中華そば', 'price' => '550'],
            ];
        foreach ($ramens as $ramen) {
            DB::table('products')->insert([
            'name' => $ramen['name'],
            'price' => $ramen['price'],
            ]);
        }
    }
}
