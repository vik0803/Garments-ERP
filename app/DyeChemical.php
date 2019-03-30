<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DyeChemical extends Model
{
    protected $fillable = [
      'color','classification','dyes','concentration','bulk_density'
    ];
}
