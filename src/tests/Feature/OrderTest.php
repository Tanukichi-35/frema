<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Order;

class OrderTest extends TestCase
{
    use RefreshDatabase;
    private $address;

    // テストデータの作成
    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:fresh');
        $this->seed([
            'UsersTableSeeder',
            'CategoriesTableSeeder',
            'ConditionsTableSeeder',
            'AddressesTableSeeder',
            'ItemsTableSeeder',
            'ItemCategoriesTableSeeder',
        ]);
        $this->address = array(
            'postcode' => '1237890',
            'address' => '京都府京都市',
            'building' => '紅ビル-320'
        );
    }

    // 商品購入の確認
    public function test_purchase(){
        $user = User::find(3);
        // 認証情報の付与
        $this->actingAs($user);

        /////////////////////
        // 注文情報の作成
        /////////////////////
        $item = Item::all()->first();
        $response = $this->get('/purchase/'.$item->id);

        $response->assertStatus(200);
        $response->assertSessionHas('order');

        /////////////////////
        // 配送先の変更
        /////////////////////
        $response = $this->post('/address',[
            'postcode' => $this->address['postcode'],
            'address' => $this->address['address'],
            'building' => $this->address['building']
        ]);

        // 住所の情報がsessionに登録されていることを確認
        $response->assertRedirect('/purchase/'.$item->id);
        $response->assertSessionHas('address');

        /////////////////////
        // 支払い方法の変更
        /////////////////////

        // デフォルトはクレジットカード払い
        $response->assertSessionHas('order', function (Order $order) {
            return $order->payment === 0;
        });

        // コンビニ払いに変更
        $response = $this->post('/payment',[
            'payment' => 1,   
        ]);

        // 支払い方法が変更されていることを確認
        $response->assertRedirect('/purchase/'.$item->id);
        $response->assertSessionHas('order', function (Order $order) {
            return $order->payment === 1;   
        });

    }
}
