<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
  protected $fillable = [
    'value',
    'quantity',
    'product_id'
  ];
}
