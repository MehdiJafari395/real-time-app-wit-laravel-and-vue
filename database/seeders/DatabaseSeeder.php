<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Question;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(10)->create();
        Category::factory()->count(5)->create();
        Question::factory()->count(10)->create();
        Reply::factory()->count(50)->create();
    }
}
