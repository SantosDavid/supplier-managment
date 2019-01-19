<?php

use Illuminate\Database\Seeder;
use App\Models\Admin\Company;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email' => 'test@test.com.br',
            'password' => \Hash::make('123456'),
            'company_id' => Company::first()->id,
        ]);
    }
}
