<?php

namespace App\Modules\Site\Database\Factories;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'categories';

  /**
   * @var array
   */
  protected $fillable = [
    'id',
    'title',
    'alias',
    'parent',
    'acrm_id',
    'created_at',
    'updated_at',
  ];

}