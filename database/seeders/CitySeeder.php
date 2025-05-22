<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        City::factory()
            ->count(5)
            ->has(Citizen::factory()->count(fake()->numberBetween(5, 15)))
            ->create();
    }
}
