<?php

namespace App\Modules\Site\Database\Factories;

use Illuminate\Database\Eloquent\Model;

class ProductsCategories extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'products_categories';

  /**
   * @var array
   */
  protected $fillable = [
    'categories_id',
    'products_id',
  ];

}