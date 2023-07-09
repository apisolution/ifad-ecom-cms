<?php

namespace Modules\Inventory\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Modules\Inventory\Entities\Inventory;
use Modules\Inventory\Entities\InventoryVariant;

class InventoryDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Inventory::insert([
            [
                'id'=> '1',
                'product_id'=> '21',
                'title'=> 'Chips Pillow',
                'sku'=> Str::random(6),
                'sale_price'=> '8.5',
                'offer_price'=> '7.5',
                'offer_start'=> now()->subDays(7),
                'offer_end' => now()->subDays(21),
                'stock_quantity' => '5800',
                'reorder_quantity' => '50',
                'is_special_deal' => '1',
                'is_manage_stock' => '1',
                'min_order_quantity' => '10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id'=> '2',
                'product_id'=> '21',
                'title'=> 'Chips Pillow 2',
                'sku'=> Str::random(6),
                'sale_price'=> '9.5',
                'offer_price'=> '8.5',
                'offer_start'=> now()->subDays(7),
                'offer_end' => now()->subDays(21),
                'stock_quantity' => '3500',
                'reorder_quantity' => '50',
                'is_special_deal' => '1',
                'is_manage_stock' => '1',
                'min_order_quantity' => '10',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        InventoryVariant::insert([
            [
                'inventory_id'=> '1',
                'variant_id'=> '6',
                'variant_option_id'=> '4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'inventory_id'=> '1',
                'variant_id'=> '8',
                'variant_option_id'=> '5',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'inventory_id'=> '2',
                'variant_id'=> '8',
                'variant_option_id'=> '19',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
