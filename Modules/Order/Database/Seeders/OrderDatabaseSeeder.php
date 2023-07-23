<?php

namespace Modules\Order\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Order\Entities\Order;
use Modules\Order\Entities\OrderItem;

class OrderDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Order::create([
            'id' => 1,
            'order_date' => now(),
            'customer_id' => '1',
            'shipping_address' => 'House 04, Flat, 7A Road 23/A, Dhaka 1213',
            'billing_address' => 'House 04, Flat, 7A Road 23/A, Dhaka 1213',
            'total' => '120',
            'discount' => '10',
            'shipping_charge' => '5',
            'tax' => '0',
            'grand_total' => '115',
            'payment_method_id' => '',
            'payment_details' => json_encode([]),
            'payment_status_id' => Order::PAYMENT_STATUS_PAID,
            'order_status_id' => Order::ORDER_STATUS_DELIVERED,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        OrderItem::insert([
            [
                'order_id' => 1,
                'type' => 'product',
                'inventory_id' => '1',
                'combo_id' => Null,
                'quantity' => '100',
                'unit_price' => '8.5',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);


        // -----------------------------------------------------

        Order::create([
            'id' => 2,
            'order_date' => now(),
            'customer_id' => '1',
            'shipping_address' => 'House 04, Flat, 7A Road 23/A, Dhaka 1213',
            'billing_address' => 'House 04, Flat, 7A Road 23/A, Dhaka 1213',
            'total' => '120',
            'discount' => '10',
            'shipping_charge' => '5',
            'tax' => '0',
            'grand_total' => '115',
            'payment_method_id' => '',
            'payment_details' => json_encode([]),
            'payment_status_id' => Order::PAYMENT_STATUS_PAID,
            'order_status_id' => Order::ORDER_STATUS_DELIVERED,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        OrderItem::insert([
            [
                'order_id' => 2,
                'type' => 'combo',
                'inventory_id' => Null,
                'combo_id' => '1',
                'quantity' => '100',
                'unit_price' => '8.5',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
