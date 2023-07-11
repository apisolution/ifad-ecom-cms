<?php

namespace Modules\Customer\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Modules\Customer\Entities\Customer;

class CustomerDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Customer::create([
            'name'=>'Md. Masudul Kabir',
            'email'=> 'customer@demo.com',
            'password' => Hash::make('123456'),
            'api_token' => Null,
            "address" => "43/44 Nawabpur Road, Dhaka: 1100",
            "date_of_birth" => "1989-10-01",
            "gender" => "male",
            "phone_number" => "01676717945",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
