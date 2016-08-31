<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/list-stock', function() {
  $begin = memory_get_usage();
  foreach (DB::table('product')->get() as $product) {
    if ( $product->stock > 20 ) {
      echo $product->name . ' : ' . $product->stock . '<br>';
    }
  }
  echo 'Total memory usage : ' . (memory_get_usage() - $begin);
});

Route::get('/list-stock-chunk', function() {
  $begin = memory_get_usage();
  DB::table('product')->chunk(100, function($products)
  {
    foreach ($products as $product)
    {
      if ( $product->stock > 20 ) {
        echo $product->name . ' : ' . $product->stock . '<br>';
      }
    }
  });
  echo 'Total memory usage : ' . (memory_get_usage() - $begin);
});

Route::resource('orders', 'OrdersController');
Route::get('/orders', 'OrdersController@index' );
