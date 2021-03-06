<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\slugAutoCreator;


class SubCategory extends Model
{
    use slugAutoCreator;

    protected $fillable = [
      'title',
      'base_category_id',
    ];

    public function base_category(){
      return $this->belongsTo('App\Category');
    }

    public function products(){
      return $this->hasMany('App\Product');
    }

    public function sizes(){
      return $this->hasMany('App\Size');
    }

    public static function boot(){
      parent::boot();
      static::creating(function($subcategory) {
        $subcategory->create_slug();
      });
    }
}
