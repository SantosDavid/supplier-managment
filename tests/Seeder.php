<?php

namespace Tests;

use Artisan;

trait Seeder
{
    public function runSeeder(Array $seeders)
    {
        foreach ($seeders as $seeder) {
            Artisan::call('db:seed', ['--class' => $seeder]);
        }
    }
}
