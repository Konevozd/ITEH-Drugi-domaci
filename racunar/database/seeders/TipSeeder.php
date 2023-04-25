<?php

namespace Database\Seeders;

use App\Models\Tip;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tip::create([
            'tip' => 'Stoni'
        ]);

        Tip::create([
            'tip' => 'Mobilni'
        ]);

        Tip::create([
            'tip' => 'Laptop'
        ]);
    }
}
