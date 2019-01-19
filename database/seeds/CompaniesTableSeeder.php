<?php

use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            'name' => 'Test Company',
            'phone' => '(11) 2040-0193',
            'cnpj' => '51.592.772/0001-09',
        ]);
    }
}
