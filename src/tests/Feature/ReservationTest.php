<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Database\Seeders\DatabaseSeeder;
use Tests\TestCase;
use App\Models\Shop;
use App\Models\User;
use App\Models\Reservation;

class ReservationTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    /**予約機能 */
    /*予約情報追加 */
    public function test_reserve_shop()
    {
        $user = User::find(3);
        $response = $this->actingAs($user);

        $response = $this->from(route('show', 1))->post(route('store', 1), [
            'user_id' => $user->id,
            'shop_id' => 1,
            'date' => '2025-01-01',
            'time' => '00:00:00',
            'number' => 1,
        ]);

        $this->assertDatabaseHas('reservations',[
            'user_id' => $user->id,
            'shop_id' => 1,
            'date' => '2025-01-01',
            'time' => '00:00:00',
            'number' => 1,
        ]);
        $response->assertRedirect('/done');
    }

    /*バリデーション */
    /*日付未入力 */
    public function test_reservation_requires_date()
    {
        $user = User::find(3);
        $response = $this->actingAs($user);

        $response = $this->from(route('show', 1))->post(route('store', 1), [
            'user_id' => $user->id,
            'shop_id' => 1,
            'date' => '',
            'time' => '00:00:00',
            'number' => 1,
        ]);

        $response->assertSessionHasErrors(['date' => '日付を入力してください']);
        $response->assertStatus(302);
        $response->assertRedirect(route('show', 1));
    }
    /*時間未入力 */
    public function test_reservation_requires_time()
    {
        $user = User::find(3);
        $response = $this->actingAs($user);

        $response = $this->from(route('show', 1))->post(route('store', 1), [
            'user_id' => $user->id,
            'shop_id' => 1,
            'date' => '2025-01-01',
            'time' => '',
            'number' => 1,
        ]);

        $response->assertSessionHasErrors(['time' => '時間を入力してください']);
        $response->assertStatus(302);
        $response->assertRedirect(route('show', 1));
    }
    /*人数未選択 */
    public function test_reservation_requires_number()
    {
        $user = User::find(3);
        $response = $this->actingAs($user);

        $response = $this->from(route('show', 1))->post(route('store', 1), [
            'user_id' => $user->id,
            'shop_id' => 1,
            'date' => '2025-01-01',
            'time' => '00:00:00',
            'number' => '',
        ]);

        $response->assertSessionHasErrors(['number' => '人数を選択してください']);
        $response->assertStatus(302);
        $response->assertRedirect(route('show', 1));
    }

    /*予約削除機能 */
    public function test_delete_reservation()
    {
        $user = User::find(3);
        $response = $this->actingAs($user);
        $reservation = Reservation::factory()->create([
            'user_id' => $user->id,
            'shop_id' => 1,
            'date' => '2025-01-01',
            'time' => '00:00:00',
            'number' => 1,
        ]);

        $response = $this->from(route('mypage'))->post(route('remove', $reservation->id));

        $this->assertDatabaseMissing('reservations',[
            'id' => $reservation->id,
            'user_id' => $user->id,
            'shop_id' => 1,
            'date' => '2025-01-01',
            'time' => '00:00:00',
            'number' => 1,
        ]);
    }

    /*予約変更機能 */
    public function test_edit_reservation()
    {
        $user = User::find(3);
        $reservation = Reservation::factory()->create([
            'user_id' => $user->id,
            'shop_id' => 1,
            'date' => '2025-01-01',
            'time' => '00:00:00',
            'number' => 1,
        ]);

        $response = $this->actingAs($user)->from(route('edit', $reservation->id))->post(route('update', $reservation->id), [
            'date' => '2025-01-02',
            'time' => '12:00:00',
            'number' => 3,
        ]);

        $this->assertDatabaseHas('reservations', [
            'user_id' => $user->id,
            'shop_id' => 1,
            'date' => '2025-01-02',
            'time' => '12:00:00',
            'number' => 3,
        ]);
        $response->assertRedirect(route('mypage'));
    }
}
