<?php

namespace Sebastienheyd\Boilerplate\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
  protected $fillable = [
    'name',
    'slug',
];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';
}
