<?php

namespace Modules\Combo\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Modules\Combo\Entities\Combo;
use Modules\Combo\Entities\ComboItem;

class ComboDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Combo::insert([
            [
                'id'=> '1',
                'combo_category_id'=> '1',
                'title'=> 'Chips Bundle 002',
                'sku'=> Str::random(6),
                'sale_price'=> '150',
                'offer_price'=> '120',
                'offer_start'=> now()->subDays(7),
                'offer_end' => now()->subDays(21),
                'stock_quantity' => '200',
                'reorder_quantity' => '10',
                'is_special_deal' => '1',
                'is_manage_stock' => '1',
                'min_order_quantity' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        ComboItem::insert([
            [
                'combo_id'=> '1',
                'inventory_id'=> '1',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // $this->call("OthersTableSeeder");
    }
}
