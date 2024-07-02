<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Comment;

class CommentsTest extends TestCase
{
    use RefreshDatabase;
    private $user;
    private $item;
    private $comment;

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
        $this->user = User::factory()->create();
        $this->item = Item::all()->first();
        $this->comment = "test comment";
    }

    // コメントの投稿の確認
    public function test_comments(){
        // 認証情報の付与
        $this->actingAs($this->user);

        // コメント数を取得
        $dataCount = Comment::all()->count();

        // コメントの投稿
        $response = $this->post('/comment',[
            'item_id' => $this->item->id,
            'comment' => $this->comment,
        ]);

        // コメント数の増加を確認
        $this->assertDatabaseCount('comments', $dataCount + 1);

        // 投稿したコメントと保存されているコメントが一致していることを確認
        $this->assertDatabaseHas('comments',[
            'user_id' => $this->user->id,
            'item_id' => $this->item->id,
            'comment' => "$this->comment",
        ]);
    }
}
