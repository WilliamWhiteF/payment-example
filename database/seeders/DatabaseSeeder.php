<?php

namespace Database\Seeders;

use App\Domains\Payment\Models\User as ModelsUser;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        ModelsUser::factory(10)
            ->create();

        ModelsUser::factory(2)
            ->shopkeeper()
            ->create();
    }
}
