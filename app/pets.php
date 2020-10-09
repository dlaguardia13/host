<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pets extends Model
{
    protected $primaryKey='id_pet';
    public $timestamps = false;
}
