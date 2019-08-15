<?php

namespace App\Modules\Site\Database\Factories;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'products';

  /**
   * @var array
   */
  protected $fillable = [
    'id',
    'title',
    'image',
    'description',
    'first_invoice',
    'last_supplied',
    'category_google',
    'url',
    'price',
    'amount',
    'discount_price',
    'created_at',
    'updated_at',
  ];

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function products_offers()
  {
    return $this->hasMany('App\Modules\Site\Database\Factories\ProductsOffers', 'products_id', 'id');
  }
}