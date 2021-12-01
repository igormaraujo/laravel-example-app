<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\Employee;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Company::factory(25)
            ->has(Employee::factory(rand(1,30)))
            ->create();
        $this->call([
            UserSeeder::class,
        ]);
    }
}
