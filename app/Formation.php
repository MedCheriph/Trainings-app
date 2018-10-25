<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    protected $fillable = [
    	'code_formation', 
    	'intitule_formation',
    	'duree_formation',
    	'objectif',
    	'prerequis',
    	'deb_pro', 
    	'prix_formation'
    ];
}
