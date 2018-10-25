<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = ['id_formation', 'date_lancement', 'date_debut', 'date_fin', 'pourcentage', 'prix_c'];
}
