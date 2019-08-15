<?php

namespace App\Modules\Site\Database\Factories;

use Illuminate\Database\Eloquent\Model;

class Offers extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'offers';

  /**
   * @var array
   */
  protected $fillable = [
    'id',
    'price',
    'amount',
    'sales',
    'article',
    'discount_value',
    'discount_price',
    'created_at',
    'updated_at',
  ];

}