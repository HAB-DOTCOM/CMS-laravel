<?php

use Illuminate\Database\Seeder;
//use App\Database\seeds\UsersTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $this->call(UsersTableSeeder::class);
      $this->call(PostsTbaleSeeder::class);
    }
}
