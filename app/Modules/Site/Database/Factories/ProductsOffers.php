<?php

namespace App\Modules\Site\Database\Factories;

use Illuminate\Database\Eloquent\Model;

class ProductsOffers extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'products_offers';

  /**
   * @var array
   */
  protected $fillable = [
    'products_id',
    'offers_id',
  ];

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasOne
   */
  public function offer()
  {
    return $this->hasOne('App\Modules\Site\Database\Factories\Orders', 'id', 'offers_id');
  }
}