<?php

namespace Database\Seeders;

use App\Models\Proizvodjac;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProizvodjacSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Proizvodjac::create([
            'proizvodjac' => 'Apple'
        ]);

        Proizvodjac::create([
            'proizvodjac' => 'Dell'
        ]);

        Proizvodjac::create([
            'proizvodjac' => 'LG'
        ]);
    }
}
