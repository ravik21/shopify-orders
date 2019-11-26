<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Shop;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
          [
            'name'     => 'admin',
            'email'    => 'admin@gmail.com',
            'password' => '12345678'
          ],
          [
            'name'     => 'user',
            'email'    => 'user@gmail.com',
            'password' => '12345678'
          ],
          [
            'name'     => 'test',
            'email'    => 'test@gmail.com',
            'password' => '12345678'
          ]
        ];

        Shop::updateOrcreate([
          'name'  =>  'ravi-web-store',
        ],[
          'url'   =>  'https://ravi-web-store.myshopify.com'
        ]);

        $shop = Shop::first();

        foreach ($users as $key => $user) {
          User::updateOrcreate([
            'shop_id'  => $shop->id,
            'email'    => $user['email']
          ],[
            'name'     => $user['name'],
            'password' => Hash::make($user['password'])
          ]);
        }
    }
}
