<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Database\Seeders\DatabaseSeeder;
use Tests\TestCase;
use App\Models\User;
use App\Models\Shop;
use App\Models\Reservation;
use Carbon\Carbon;

class OwnerTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    /**店舗代表者ログイン機能 */
    /**メールアドレスが未入力 */
    public function test_login_requires_email()
    {
        $response = $this->from('/owner/login')->post('/owner/login', [
            'email' => '',
            'password' => 'owner12345',
        ]);

        $response->assertSessionHasErrors(['email' => 'メールアドレスを入力してください']);
        $response->assertStatus(302);
        $response->assertRedirect('/owner/login');
    }

    /**パスワードが未入力 */
    public function test_login_requires_password()
    {
        $response = $this->from('/owner/login')->post('/owner/login', [
            'email' => 'owner@example.com',
            'password' => '',
        ]);

        $response->assertSessionHasErrors(['password' => 'パスワードを入力してください']);
        $response->assertStatus(302);
        $response->assertRedirect('/owner/login');
    }

    /**入力情報が間違っている */
    public function test_login_invalid_credentials_error()
    {
        $invalidCredentials = [
            'email' => 'nonexistent@example.com',
            'password' => 'invalid-password',
        ];

        $response = $this->from('/owner/login')->post('/owner/login', $invalidCredentials);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['login_error' => 'ログイン情報が登録されていません']);
        $response->assertRedirect('/owner/login');
    }

    /**全ての項目が正しく入力されている場合 */
    public function test_successful_login()
    {
        $user = User::skip(1)->first();

        $response = $this->post('/owner/login', [
            'email' => 'owner@example.com',
            'password' => 'owner12345',
        ]);

        $this->assertAuthenticatedAs($user, 'owner');
        $response->assertRedirect(route('owner.shop'));
    }

    /**店舗情報作成 */
    public function test_create_new_shop()
    {
        $user = User::skip(1)->first();

        Storage::fake('public');
        $image = UploadedFile::fake()->image('test.jpg');

        $expectedPath = 'images/' . $image->getClientOriginalName();

        $response = $this->actingAs($user, 'owner')->from(route('owner.register'))->post(route('owner.store'), [
            'image' => $image,
            'name' => 'test',
            'area_id' => 1,
            'category_id' => 1,
            'description' =>'create shop test',
        ]);

        Storage::disk('public')->assertExists($expectedPath);

        $this->assertDatabaseHas('shops', [
            'name' => 'test',
        ]);
        $response->assertRedirect(route('owner.shop'));
    }
    /**店舗情報更新 */
    public function test_edit_shop_info()
    {
        $user = User::skip(1)->first();
        $shop = Shop::factory()->create(['user_id' => $user->id,]);

        Storage::fake('public');
        $image = UploadedFile::fake()->image('test.jpg');

        $expectedPath = 'images/' . $image->getClientOriginalName();

        $response = $this->actingAs($user, 'owner')->from(route('owner.detail', $shop->id))->post(route('owner.edit', $shop->id), [
            'user_id' => $user->id,
            'image' => $image,
            'name' => 'test',
            'area_id' => 1,
            'category_id' => 1,
            'description' =>'edit shop test',
        ]);

        Storage::disk('public')->assertExists($expectedPath);

        $this->assertDatabaseHas('shops', [
            'id' => $shop->id,
            'name' => 'test',
            'area_id' => 1,
            'category_id' => 1,
            'description' =>'edit shop test',
        ]);
        $this->assertTrue(str_contains(Shop::find($shop->id)->image, 'storage/images/test.jpg'));
        $response->assertRedirect(route('owner.shop'));
    }

    /**予約情報取得 */
    public function test_display_reservation_list()
    {
        $owner = User::skip(1)->first();

        $user = User::factory()->create([
            'id' => 4,
            'name' => 'test',
        ]);

        $today = Carbon::now()->format('Y-m-d');
        $reservation = Reservation::factory()->create([
            'shop_id' => 1,
            'user_id' => 4,
            'date' => $today,
        ]);

        $response = $this->actingAs($owner, 'owner')->get(route('owner.list', 1));

        $response->assertSee('test');
    }
}
