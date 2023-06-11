<?php

namespace App\Console\Commands;

use App\Jobs\UpdateSocialAccountUserData;
use App\Jobs\UpdateTwitterUsersData;
use App\Models\SocialAccount;
use Illuminate\Console\Command;

class ClearSocialAccountAllData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'social_account:clear {--id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all social account data';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $id = $this->options()['id'] ?? 0;
        $socialAccounts = SocialAccount::where('id', $id)->get();

        $pagesDeleted = 0;
        $likesDeleted = 0;
        $postsDeleted = 0;
        $pageDataDeleted = 0;
        $followersDeleted = 0;
        $ctaDataDeleted = 0;

        foreach ($socialAccounts as $socialAccount) {
            foreach ($socialAccount->page as $page) {

                foreach ($page->post as $post) {
                    if ($post->delete()) $postsDeleted++;
                }

                foreach ($page->likeinfo as $like) {
                    if ($like->delete()) $likesDeleted++;
                }

                foreach ($page->data as $pageData) {
                    if ($pageData->delete()) $pageDataDeleted++;
                }

                foreach ($page->follower as $follower) {
                    if ($follower->delete()) $followersDeleted++;
                }

                foreach ($page->cta_data as $ctaData) {
                    if ($ctaData->delete()) $ctaDataDeleted++;
                }

                if ($page->delete()) $pagesDeleted++;
            }
        }

        echo "Pages deleted: {$pagesDeleted}" . PHP_EOL;
        echo "Posts deleted: {$postsDeleted}" . PHP_EOL;
        echo "Likes deleted: {$likesDeleted}" . PHP_EOL;
        echo "Page Data deleted: {$pageDataDeleted}" . PHP_EOL;
        echo "Followers deleted: {$followersDeleted}" . PHP_EOL;
        echo "Cta Data deleted: {$ctaDataDeleted}" . PHP_EOL;
    }

}
