<?php

use Illuminate\Database\Seeder;

class newsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\News::class, 30)->create();
    }
}
