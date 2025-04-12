<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Database\Seeders\DatabaseSeeder;
use Tests\TestCase;
use App\Models\Shop;
use App\Models\User;
use App\Models\Like;
use App\Models\Reservation;

class UserInfoTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    /**マイページ画面 */
    /*ユーザー情報取得, お気に入り店舗取得, 予約情報取得 */
    public function test_get_user_info()
    {
        $user = User::find(3);
        $likes = Like::factory()->count(2)->create(['user_id' => 3]);
        $reservations = Reservation::factory()->count(2)->create(['user_id' => 3]);

        $response = $this->actingAs($user)->get(route('mypage'));

        $response->assertSee($user->name);

        foreach($likes as $like){
            $response->assertSee($like->shop->name);
        }

        foreach($reservations as $reservation){
            $response->assertSee($reservation->date);
        }
    }
}
