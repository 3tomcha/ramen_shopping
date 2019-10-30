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
            '塩ラーメン',
            '味噌ラーメン',
            '豚骨ラーメン',
            '醤油ラーメン',
            '台湾ラーメン',
            '五目ラーメン',
            '中華そば',
            ];
        foreach ($ramens as $ramen) {
            DB::table('products')->insert([
            'name' => $ramen,
            ]);
        }
    }
}
