<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Puplisher;
use App\Models\Book;

class PuplisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        (new Puplisher)->factory(30)->create();
    }
}
