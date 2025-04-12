<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Database\Seeders\DatabaseSeeder;
use Tests\TestCase;
use App\Models\Shop;
use App\Models\User;

class ShopListTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    /**店舗一覧画面 */
    /*全店舗取得 */
    public function test_display_all_shops()
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        $shops = Shop::all();
        foreach ($shops as $shop) {
            $response->assertSee($shop->name);
        }
    }

    /*店舗詳細取得 */
    public function test_get_shop_detail()
    {
        $response = $this->get('/detail/1');
        $shop = Shop::find(1);

        $response->assertStatus(200);
        $response->assertSeeInOrder([
            $shop->name,
            $shop->area->name,
            $shop->category->content,
            $shop->description,
        ]);
    }

    /**検索機能 */
    /*部分一致検索 */
    public function test_search_displays_matching_items()
    {
        $matchingShops = Shop::factory()->count(2)->create(['name' => 'matching']);
        $nonMatchingShops = Shop::factory()->count(2)->create(['name' => 'unrelated']);

        $response = $this->get(route('index', ['name' => 'match']));

        foreach ($matchingShops as $shop) {
            $response->assertSee($shop->name);
        }

        foreach ($nonMatchingShops as $shop) {
            $response->assertDontSee($shop->name);
        }
    }
    /*エリア絞込検索 */
    public function test_sort_by_area()
    {
        $matchingShops = Shop::factory()->count(2)->create(['area_id' => 1]);
        $nonMatchingShops = Shop::factory()->count(2)->create(['area_id' => 2]);

        $response = $this->get(route('index', ['area_id' => 1]));

        foreach ($matchingShops as $shop) {
            $response->assertSee($shop->name);
        }

        foreach ($nonMatchingShops as $shop) {
            $response->assertDontSee($shop->name);
        }
    }
    /*ジャンル絞込検索 */
    public function test_sort_by_category()
    {
        $matchingShops = Shop::factory()->count(2)->create(['category_id' => 1]);
        $nonMatchingShops = Shop::factory()->count(2)->create(['category_id' => 2]);

        $response = $this->get(route('index', ['category_id' => 1]));

        foreach ($matchingShops as $shop) {
            $response->assertSee($shop->name);
        }

        foreach ($nonMatchingShops as $shop) {
            $response->assertDontSee($shop->name);
        }
    }

    /**いいね機能 */
    public function test_like_item()
    {
        $user = User::find(3);
        $response = $this->actingAs($user)->post('/like/1');

        $response->assertStatus(302);
        $this->assertDatabaseHas('likes', [
            'user_id' => 3,
            'shop_id' => 1
        ]);

        $response = $this->actingAs($user)->post('/unlike/1');

        $response->assertStatus(302);
        $this->assertDatabaseMissing('likes', [
            'user_id' => 3,
            'shop_id' => 1
        ]);
    }
}
