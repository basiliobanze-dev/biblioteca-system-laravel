<?php

use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Book::factory()->count(40)->create();
        // factory(\App\User::class, 40)->create();
    }
}
