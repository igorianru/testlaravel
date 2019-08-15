<?php

namespace App\Modules\Site\Database\Factories;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'orders';

  /**
   * @var array
   */
  protected $fillable = [
    'id',
    'order_number',
  ];

}