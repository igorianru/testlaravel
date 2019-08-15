<?php

namespace App\Modules\Site\Database\Factories;

use Illuminate\Database\Eloquent\Model;

class OrdersProducts extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'orders_products';

  /**
   * @var array
   */
  protected $fillable = [
    'order_id',
    'product_id',
  ];
}