<?php

namespace App\Console\Commands;

use App\Jobs\UpdateSocialAccountUserData;
use App\Jobs\UpdateTwitterUsersData;
use App\Models\SocialAccount;
use Illuminate\Console\Command;

class CountSocialAccountAllData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'social_account:count {--id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Count all social account data';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $id = $this->options()['id'] ?? 0;
        $socialAccounts = SocialAccount::where('id', $id)->get();

        $pagesCount = 0;
        $likesCount = 0;
        $postsCount = 0;
        $pageDataCount = 0;
        $followersCount = 0;
        $ctaDataCount = 0;
        $tweetCount = 0;
        $tweetDataCount = 0;
        $adsAccountCount = 0;

        foreach ($socialAccounts as $socialAccount) {
            $pagesCount += $socialAccount->page->count();
            $adsAccountCount += $socialAccount->ads_account->count();

            foreach ($socialAccount->page as $page) {
                $postsCount += $page->post->count();
                $likesCount += $page->likeinfo->count();
                $pageDataCount += $page->data->count();
                $followersCount += $page->follower->count();
                $ctaDataCount += $page->cta_data->count();
            }

            $tweetCount = $socialAccount->tweet->count();
            foreach ($socialAccount->tweet as $tweet) {
                $tweetDataCount += $tweet->tweet_data->count();
            }
        }

        echo "Pages: {$pagesCount}" . PHP_EOL;
        echo "Posts: {$postsCount}" . PHP_EOL;
        echo "Likes: {$likesCount}" . PHP_EOL;
        echo "Page Data: {$pageDataCount}" . PHP_EOL;
        echo "Followers: {$followersCount}" . PHP_EOL;
        echo "Cta Data: {$ctaDataCount}" . PHP_EOL;
        echo "Tweet: {$tweetCount}" . PHP_EOL;
        echo "Tweet Data: {$tweetDataCount}" . PHP_EOL;
        echo "Ads Accounts: {$adsAccountCount}" . PHP_EOL;
    }

}
