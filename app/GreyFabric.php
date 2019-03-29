<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GreyFabric extends Model
{
    protected $fillable=[
      'content', 'material', 'quantity', 'width', 'weight', 'finish', 'transparency', 'fire_rating', 'use', 'care'
    ];
}
