<?php 
  namespace Sebastienheyd\Boilerplate\Models;
  use Illuminate\Database\Eloquent\Model;

  class Articles extends Model {
    protected $fillable = [
      'title',
      'slug',
      'excerpt',
      'body',
      'image_path'
    ];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'articles';
  }
?>