<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    private $user;

    // テストユーザーの作成
    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        // $this->seed('UsersTableSeeder');
    }

    // ログインページへのアクセス確認
    public function test_access_login_page()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    // ログイン処理（成功）の確認
    public function test_login_success(){
        $response = $this->from('/login')
            ->post('/login',[
            '_token' => csrf_token(),
            'email' => $this->user->email,
            'password' => 'password',
        ]);
        $response->assertRedirect('/');
        $this->assertAuthenticatedAs($this->user);
    }

    // ログアウト処理の確認
    public function test_logout(){
        $response = $this->actingAs($this->user)->post('/logout');
        $response->assertRedirect('/login');
        $this->assertGuest();
    }

    // ログイン処理（失敗）の確認
    public function test_login_failure(){
        $response = $this->from('/login')
            ->post('/login',[
            '_token' => csrf_token(),
            'email' => $this->user->email,
            'password' => 'pasword',
        ]);
        $response->assertRedirect('/login');
        $this->assertGuest();
    }
}
