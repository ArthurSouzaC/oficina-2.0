<?php

use Illuminate\Database\Seeder;
use App\Quote;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Quote::class, 54)->create();
    }
}
