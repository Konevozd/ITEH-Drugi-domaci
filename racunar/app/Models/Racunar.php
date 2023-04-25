<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Racunar extends Model
{
    use HasFactory;

    protected $fillable = ['proizvodjacID','model', 'tipID', 'specifikacija'];

    protected $table = 'racunar';

}
