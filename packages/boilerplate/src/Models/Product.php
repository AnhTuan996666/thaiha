<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $fillable = [
    'id',
    'name',
    'slug',
    'quocte_file',
    'image_padth',
    'description',
];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';
}
