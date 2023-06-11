<?php


namespace Tests\Feature\Services;

use App\Classes\FacebookAPIMock;
use App\Models\SocialAccount;
use App\Models\Page;
use App\Services\Social\FacebookService;
use Database\Factories\PageFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FacebookServiceTest extends TestCase
{

    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_update_user_data()
    {
        $socialAccount = SocialAccount::create([
            'provider_name' => 'facebook',
            'provider_id' => '265417892230407',
            'full_name' => 'Salahdeen Swessi'
        ]);

        $page1 = Page::create(['page_id' => '108210311715797', 'name' => 'Afdal Analytics', 'social_account_id' => $socialAccount->id]);
        Page::create(['page_id' => '100427272065984', 'name' => 'Everyday Sport', 'social_account_id' => $socialAccount->id]);

        $service = new FacebookService($socialAccount);
        $service->setApi(new FacebookAPIMock);
        $service->updateUserData();

        $this->assertDatabaseCount('social_accounts', 1);

        // PAGES
        $this->assertDatabaseCount('pages', 2);
        $this->assertDatabaseHas('pages', ['name' => 'Afdal Analytics After Update']);
        $this->assertDatabaseHas('pages', ['name' => 'EveryDay Sport After Update']);

        // POSTS
        $this->assertDatabaseCount('posts', 40); // 20 records x 2 pages
        $this->assertDatabaseHas('posts', ['text' => 'Hello world']);
        $this->assertDatabaseHas('posts', ['text' => 'Just do it']);

        // LIKES
        $this->assertDatabaseCount('page_likes', 178); // 89 records x 2 pages
        $this->assertDatabaseHas('page_likes', [
            'page_id' => $page1->id,
            'date' => '2022-04-16',
            'likes' => 30,
            'unlikes' => 123,
            'paid_likes' => 3,
            'unpaid_likes' => 17
        ]);

        // PAGE DATA
        $this->assertDatabaseCount('page_data', 178); // 89 records x 2 pages
        $this->assertDatabaseHas('page_data', ['date' => '2022-03-15', 'total_day_online' => 241]);
        $this->assertDatabaseHas('page_data', ['date' => '2022-03-15', 'total_hour_online' => 11]);
        $this->assertDatabaseHas('page_data', ['date' => '2022-03-15', 'top_hour_online' => 13]);
        $this->assertDatabaseHas('page_data', ['date' => '2022-04-03', 'total_day_online' => 27]);
        $this->assertDatabaseHas('page_data', ['date' => '2022-04-03', 'total_hour_online' => 3]);
        $this->assertDatabaseHas('page_data', ['date' => '2022-04-03', 'top_hour_online' => 11]);

        // CTA DATA
        $this->assertDatabaseCount('cta_data', 28); // 14 records x 2 pages
        $this->assertDatabaseHas('cta_data', ['date' => '2022-04-01', 'city' => 'Samalut', 'reach' => 720]);
        $this->assertDatabaseHas('cta_data', ['date' => '2022-04-02', 'city' => 'Alexandria', 'reach' => 6729]);
    }

    public function test_doubled_of_update_user_data()
    {
        // TODO:: create likes
        $socialAccount = SocialAccount::create([
            'provider_name' => 'facebook',
            'provider_id' => '265417892230407',
            'full_name' => 'Salahdeen Swessi'
        ]);

        Page::create(['page_id' => '108210311715797', 'name' => 'Afdal Analytics', 'social_account_id' => $socialAccount->id]);
        Page::create(['page_id' => '100427272065984', 'name' => 'Everyday Sport', 'social_account_id' => $socialAccount->id]);

        // first data update
        $service = new FacebookService($socialAccount);
        $service->setApi(new FacebookAPIMock);
        $service->updateUserData();

        // repeat data update
        $socialAccount->last_imported_at = null;
        $socialAccount->save();

        $service = new FacebookService($socialAccount);
        $service->setApi(new FacebookAPIMock);
        $service->updateUserData();

        $this->assertDatabaseCount('social_accounts', 1);
        $this->assertDatabaseCount('pages', 2);
        $this->assertDatabaseCount('posts', 40); // 20 records x 2 pages
        $this->assertDatabaseCount('page_likes', 178); // 89 records x 2 pages
        $this->assertDatabaseCount('page_data', 178); // 89 records x 2 pages
        $this->assertDatabaseCount('cta_data', 28); // 14 records x 2 pages
    }
}