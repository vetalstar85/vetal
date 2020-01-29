<?php

use Illuminate\Database\Seeder;

class offersTableSeederFatrory extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\models\offer::class,150)->create();
    }
}
