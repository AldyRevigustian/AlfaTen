<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Discount;
use App\Models\Product;
use App\Models\Role;
use App\Models\Stock;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FirstSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Aldey',
            'email' => 'aldyrevig@gmail.com',
            'username' => 'Dey',
            'password' => Hash::make('password')
        ]);
        User::create([
            'name' => 'Revi',
            'email' => 'revialdy@gmail.com',
            'username' => 'Rev',
            'password' => Hash::make('password')
        ]);
        User::create([
            'name' => 'Gustian',
            'email' => 'dey@gmail.com',
            'username' => 'Gustian',
            'password' => Hash::make('password')
        ]);

        Role::create(['name' => 'Customer',]);
        Role::create(['name' => 'Cashier',]);
        Role::create(['name' => 'Manager',]);

        UserRole::create([
            'user_id' => 1,
            'role_id' => 3
        ]);

        UserRole::create([
            'user_id' => 2,
            'role_id' => 2
        ]);

        UserRole::create([
            'user_id' => 3,
            'role_id' => 1
        ]);

        Category::create(['name' => 'Snacks']);
        Category::create(['name' => 'Foods & Goods']);
        Category::create(['name' => 'Drinks']);
        Category::create(['name' => 'Beauties']);
        Category::create(['name' => 'Medicine']);

        Product::create([
            'name' => 'Chitato',
            'price' => 11500,
            'thumbnail' => 'chitato.jpg',
            'desc' => 'Enak tau',
            'category_id' => 1
        ]);
        Product::create([
            'name' => 'Lays',
            'price' => 11300,
            'thumbnail' => 'Lays.jpg',
            'desc' => 'Enak tau',
            'category_id' => 1
        ]);

        Product::create([
            'name' => 'Indomie Goreng',
            'price' => 3500,
            'thumbnail' => 'indomie.jpg',
            'desc' => 'Lejat bergiji',
            'category_id' => 2
        ]);

        Product::create([
            'name' => 'Pocari Sweat',
            'price' => 7000,
            'thumbnail' => 'pocari.jpg',
            'desc' => 'Segar',
            'category_id' => 3
        ]);

        Product::create([
            'name' => 'Scarlett Whitening',
            'price' => 52000,
            'thumbnail' => 'scarlett.jpg',
            'desc' => 'Putih berkilau',
            'category_id' => 4
        ]);

        Product::create([
            'name' => 'Bodrex',
            'price' => 5000,
            'thumbnail' => 'bordrex.jpg',
            'desc' => 'Obat sakit kepala',
            'category_id' => 5
        ]);

        Stock::create([
            'product_id' => 1,
            'quantity' => 50,
            'expire_date' => '2023-05-01'
        ]);

        Stock::create([
            'product_id' => 2,
            'quantity' => 50,
            'expire_date' => '2023-05-01'
        ]);

        Stock::create([
            'product_id' => 3,
            'quantity' => 50,
            'expire_date' => '2023-05-01'
        ]);

        Stock::create([
            'product_id' => 4,
            'quantity' => 50,
            'expire_date' => '2023-05-01'
        ]);

        Stock::create([
            'product_id' => 5,
            'quantity' => 50,
            'expire_date' => '2023-05-01'
        ]);

        Transaction::create([
            'product_id' => 1,
            'user_id' => 2,
            'quantity' => 3,
            'status' => 'unpaid',
            'invoice_code' => 'INV_32301',
        ]);

        Transaction::create([
            'product_id' => 2,
            'user_id' => 2,
            'quantity' => 5,
            'status' => 'unpaid',
            'invoice_code' => 'INV_32301',
        ]);

        Transaction::create([
            'product_id' => 3,
            'user_id' => 2,
            'quantity' => 1,
            'status' => 'unpaid',
            'invoice_code' => 'INV_32301',
        ]);

        Transaction::create([
            'product_id' => 4,
            'user_id' => 2,
            'quantity' => 1,
            'status' => 'unpaid',
            'invoice_code' => 'INV_32301',
        ]);

        Transaction::create([
            'product_id' => 5,
            'user_id' => 2,
            'quantity' => 3,
            'status' => 'unpaid',
            'invoice_code' => 'INV_32301',
        ]);

        Discount::create([
            "product_id" => 4,
            "percentage" => 10,
            "start_date" => '2022-01-08',
            "end_date" => '2022-01-30',
        ]);

        Discount::create([
            "product_id" => 3,
            "percentage" => 5,
            "start_date" => '2022-01-08',
            "end_date" => '2022-01-15',
        ]);
    }
}
