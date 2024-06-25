<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Admin;

class AdminAuthTest extends TestCase
{
    use RefreshDatabase;
    private $admin;

    // テストユーザーの作成
    public function setUp(): void
    {
        parent::setUp();
        $this->admin = Admin::factory()->create();
        // $this->admin = $this->seed('AdminsTableSeeder');
    }

    // ログインページへのアクセス確認
    public function test_access_login_page()
    {
        $response = $this->get('/admin/login');
        $response->assertStatus(200);
    }

    // ログイン処理（成功）の確認
    public function test_login_success(){
        $response = $this->from('/admin/login')
            ->post('/admin/login',[
            '_token' => csrf_token(),
            'email' => $this->admin->email,
            'password' => 'password',
        ]);
        $response->assertRedirect('/admin/users');
        $this->assertAuthenticatedAs($this->admin, 'admins');
    }

    // ログアウト処理の確認
    public function test_logout(){
        $response = $this->actingAs($this->admin, 'admins')->post('/admin/logout');
        $response->assertRedirect('/admin/login');
        $this->assertGuest();
    }

    // ログイン処理（失敗）の確認
    public function test_login_failure(){
        $response = $this->from('/admin/login')
            ->post('/admin/login',[
            '_token' => csrf_token(),
            'email' => $this->admin->email,
            'password' => 'pasword',
        ]);
        $response->assertRedirect('/admin/login');
        $this->assertGuest();
    }
}
