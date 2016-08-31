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


Route::get('/order-product', function() {
    // memulai transaksi
    DB::transaction(function()
    {
      // Membuat record di table `orders`
      $order_id = DB::table('orders')->insertGetId(['customer_id'=>1]);

      // Menambah record baru di `order_products`
      DB::table('orders_products')->insert(['order_id'=>$order_id, 'product_id'=>5]);

      // Membayar order (mengisi field `paid_at` di table `orders`)
      DB::table('orders')->where('id',$order_id)->update(['paid_at'=>new DateTime]);

      // Mengurangi stock product
      DB::table('product')->decrement('stock');
    });

    echo "Berhasil menjual " . DB::table('products')->find(5)->name . '. <br>';
    echo "Stock terkini : " . DB::table('products')->find(5)->stock;
});
