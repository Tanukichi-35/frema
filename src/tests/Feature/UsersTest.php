<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\User;
use App\Models\Address;
use App\Models\Admin;

class UsersTest extends TestCase
{
    use RefreshDatabase;
    private $user;
    private $address;
    private $admin;

    // テストデータの作成
    public function setUp(): void
    {
        parent::setUp();
        $this->seed([
            'UsersTableSeeder',
            'AddressesTableSeeder',
        ]);
        $this->user = array(
            'name' => 'test-user-2',
            'email' => 'test@user2.com',
            'password' => 'password',
        );
        $this->address = array(
            'postcode' => '1237890',
            'address' => '京都府京都市',
            'building' => '紅ビル-320'
        );
        $this->admin = Admin::factory()->create();
    }

    // ユーザーの登録・編集・削除の確認
    public function test_comments(){
        /////////////////////
        // ユーザー登録
        /////////////////////

        // ユーザー数を取得
        $userCount = User::all()->count();

        // ユーザーを登録、同時にログイン
        $response = $this->post('/register',[
            'email' => $this->user['email'],
            'password' => $this->user['password'],
        ]);

        // ユーザー数の増加を確認
        $this->assertDatabaseCount('users', $userCount + 1);

        // 登録したユーザーが保存されていることを確認
        $this->assertDatabaseHas('users',[
            'email' => $this->user['email'],
        ]);

        // 登録したユーザーを取得
        $user = User::where('email', $this->user['email'])->first();

        // パスワードの確認
        $this->assertTrue(Hash::check($this->user['password'], $user->password));

        /////////////////////
        // プロフィール編集
        /////////////////////

        // 住所の登録数を取得
        $addressCount = Address::all()->count();

        // プロフィールの編集（住所の登録）
        $response = $this->post('/mypage/profile',[
            'name' => $this->user['name'],
            'postcode' => $this->address['postcode'],
            'address' => $this->address['address'],
            'building' => $this->address['building']
        ]);

        // 住所数の増加を確認
        $this->assertDatabaseCount('addresses', $addressCount + 1);

        // ユーザー名が入力されていることを確認
        $this->assertDatabaseHas('users',[
            'name' => $this->user['name'],
            'email' => $this->user['email'],
        ]);

        // 登録した住所が保存されていることを確認
        $this->assertDatabaseHas('addresses',[
            'postcode' => $this->address['postcode'],
            'address' => $this->address['address'],
            'building' => $this->address['building'],
        ]);

        /////////////////////
        // ユーザーの削除
        /////////////////////

        // 管理者権限なしで削除
        $response = $this->delete('/admin/user/'.$user->id);
        $this->assertDatabaseCount('users', $userCount+1);
        $this->assertDatabaseCount('addresses', $addressCount+1);

        // 管理者権限を持って削除
        $this->actingAs($this->admin, 'admins');
        $response = $this->delete('/admin/user/'.$user->id);
        $this->assertDatabaseCount('users', $userCount);
        $this->assertDatabaseCount('addresses', $addressCount);

        // データが削除されていることを確認
        $this->assertDatabaseMissing('users',[
            'name' => $this->user['name'],
            'email' => $this->user['email'],
        ]);
        $this->assertDatabaseMissing('addresses',[
            'postcode' => $this->address['postcode'],
            'address' => $this->address['address'],
            'building' => $this->address['building'],
        ]);
    }
}
