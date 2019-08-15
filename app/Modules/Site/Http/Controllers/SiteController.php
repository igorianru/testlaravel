<?php

namespace App\Modules\Site\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Site\Database\Factories\Categories;
use App\Modules\Site\Database\Factories\Offers;
use App\Modules\Site\Database\Factories\Products;
use App\Modules\Site\Database\Factories\ProductsCategories;
use App\Modules\Site\Database\Factories\ProductsOffers;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SiteController extends Controller
{
  /**
   * @var array
   */
  private $request;

  /**
   * @var Request
   */
  private $requests;

  /**
   * @var string
   */
  private $remoteDBUrl;


  /**
   * SiteController constructor.
   * @param Request $request
   */
  public function __construct(Request $request)
  {
    $this->request     = $request->all();
    $this->requests    = $request;
    $this->remoteDBUrl = 'https://markethot.ru/export/bestsp';
  }

  public function catalog($alias = null)
  {
    $menu       = ['main' => []];
    $categories = Categories::query()->get();

    if($alias) {
      $products = Products::query()
        ->join(
          'products_categories', function($join) {
          $join->type = 'LEFT OUTER';
          $join->on('products_categories.products_id', '=', 'products.id');
        }
        )
        ->join(
          'categories', function($join) {
          $join->type = 'LEFT OUTER';
          $join->on('categories.id', '=', 'products_categories.categories_id');
        }
        )

        ->limit(20)
        ->select('products.*')
        ->where('alias', '=', $alias);

      if(isset($this->request['r']))
        $products
          ->where(
            [
              ['categories.alias', '=', $alias],
              ['products.title', 'like', '%' . $this->request['r'] . '%'],
            ]
          )
          ->orWhere(
            [
              ['categories.alias', '=', $alias],
              ['products.description', 'like', '%' . $this->request['r'] . '%'],
            ]
          );

      $products = $products->get();
    } else {
      $products = Products::query()
        ->with('products_offers.offer')
        ->join(
          'products_offers', function($join) {
          $join->type = 'LEFT OUTER';
          $join->on('products_offers.products_id', '=', 'products.id');
        }
        )
        ->join(
          'offers', function($join) {
          $join->type = 'LEFT OUTER';
          $join->on('offers.id', '=', 'products_offers.offers_id');
        }
        );

      if(isset($this->request['r']))
        $products
          ->where([['products.title', 'like', '%' . $this->request['r'] . '%']])
          ->orWhere([['products.description', 'like', '%' . $this->request['r'] . '%']]);

      $products = $products
        ->orderBy('offers.sales', 'DESC')
        ->limit(20)
        ->select('products.*')
        ->get();
    }

    foreach($categories as $category)
      if(!$category->parent)
        $menu['main'][] = $category;
      else {
        if(!isset($menu[$category->parent]))
          $menu[$category->parent] = [];

        $menu[$category->parent][] = $category;
      }

    return view(
      "site.main.catalog",
      [
        'categories' => $menu,
        'products'   => $products,
      ]
    );
  }

  /**
   * Function update DB
   */
  public function parseRemoteDB()
  {
    ob_start();
    ob_implicit_flush(1);
    @ini_set('zlib.output_compression', 0);
    @ini_set('implicit_flush', 1);

    $data_products = json_decode(file_get_contents($this->remoteDBUrl));

    if($data_products) {
      foreach($data_products->products as $data_product) {
        $product = Products::query()->where('id', '=', $data_product->id)->first();

        if($product) {
          $product->title           = $data_product->title;
          $product->image           = $data_product->image;
          $product->description     = $data_product->description;
          $product->first_invoice   = $data_product->first_invoice;
          $product->last_supplied   = $data_product->last_supplied;
          $product->category_google = $data_product->category_google;
          $product->url             = $data_product->url;
          $product->price           = $data_product->price;
          $product->amount          = $data_product->amount;
          $product->discount_price  = $data_product->discount_price;
          $product->updated_at      = Carbon::now();

          $product->save();
        } else {
          Products::query()->insert(
            [
              'id'              => $data_product->id,
              'title'           => $data_product->title,
              'image'           => $data_product->image,
              'description'     => $data_product->description,
              'first_invoice'   => $data_product->first_invoice,
              'last_supplied'   => $data_product->last_supplied,
              'category_google' => $data_product->category_google,
              'url'             => $data_product->url,
              'price'           => $data_product->price,
              'amount'          => $data_product->amount,
              'discount_price'  => $data_product->discount_price,
              'created_at'      => Carbon::now(),
            ]
          );
        }

        foreach($data_product->categories as $data_category) {
          $category = Categories::query()->where('id', '=', $data_category->id)->first();

          if($category) {
            $category->title      = $data_category->title;
            $category->alias      = $data_category->alias;
            $category->parent     = $data_category->parent;
            $category->acrm_id    = $data_category->acrm_id;
            $category->acrm_id    = $data_category->acrm_id;
            $category->updated_at = Carbon::now();

            $category->save();
          } else {
            Categories::query()->insert(
              [
                'id'         => $data_category->id,
                'title'      => $data_category->title,
                'alias'      => $data_category->alias,
                'parent'     => $data_category->parent,
                'acrm_id'    => $data_category->acrm_id,
                'created_at' => Carbon::now(),
              ]
            );
          }

          ProductsCategories::query()->where('products_id', '=', $data_product->id)->delete();

          ProductsCategories::query()->insert(
            [
              'categories_id' => $data_category->id,
              'products_id'   => $data_product->id,
            ]
          );


          echo "Added/Updated Categories ID' . {$data_category->id}<br />";
        }

        foreach($data_product->offers as $data_offer) {
          $offer = Offers::query()->where('id', '=', $data_offer->id)->first();

          if($offer) {
            $offer->price          = $data_offer->price;
            $offer->amount         = $data_offer->amount;
            $offer->sales          = $data_offer->sales;
            $offer->article        = $data_offer->article;
            $offer->discount_value = $data_offer->discount_value;
            $offer->discount_price = $data_offer->discount_price;
            $offer->updated_at     = Carbon::now();

            $offer->save();
          } else {
            Offers::query()->insert(
              [
                'id'             => $data_offer->id,
                'price'          => $data_offer->price,
                'amount'         => $data_offer->amount,
                'sales'          => $data_offer->sales,
                'article'        => $data_offer->article,
                'discount_value' => $data_offer->discount_value,
                'discount_price' => $data_offer->discount_price,
                'created_at'     => Carbon::now(),
              ]
            );
          }

          ProductsOffers::query()->where('products_id', '=', $data_product->id)->delete();

          ProductsOffers::query()->insert(
            [
              'offers_id'   => $data_offer->id,
              'products_id' => $data_product->id,
            ]
          );


          echo "Added/Updated Offer ID' . {$data_offer->id}<br />";
        }

        echo "Added/Updated Product ID' . {$data_product->id}<br />";
        ob_flush();
      }
    }
  }
}