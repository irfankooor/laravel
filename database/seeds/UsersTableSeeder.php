<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::insert('insert into product (name, price, stock) values (:name, :price, :stock)', [
          'name' => "Brio Sport E",
          'price' => 180000000,
          'stock' => 14
      ]);

      DB::insert('insert into product (name, price, stock) values (:name, :price, :stock)', [
          'name' => "Brio Satya E",
          'price' => 125900000,
          'stock' => 23
      ]);

      $this->command->info('Berhasil menambah 2 mobil!');
    }
}
