<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class YarnStore extends Model
{
    protected $fillable=[
      'color', 'fiber_content' , 'weight' , 'yardageORball' , 'gauge' , 'care'
    ];
}
