<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\GetLeagueNewsAlert;

use App\Helpers\FPL\Helper as FPLHelper;
use App\Helpers\FPL\Season\SeasonHelper;

use App\Models\LeagueNews;
use App\Models\LeagueNewsCategory;
use App\Models\LeagueNewsImage;

class GetLeagueNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fpl:get-league-news';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $season = SeasonHelper::getCurrentSeason();
        if (!$season) {
            \Log::info("[GetLeagueNews] Unable to get current season");
            return;
        }

        $news = FPLHelper::getPLNewsFeed(300);

        if (!$news) {
            \Log::info("[GetLeagueNews] Retrieved no news...");
            return;
        }

        if (isset($news["success"]) && !$news["success"]) {
            \Log::info("[GetLeagueNews] " . $news["message"]);
            return;
        }

        foreach ($news as $post) {
            $hash = md5(json_encode($post));

            $category_data = $post["category"] ?? [];
            unset($post["category"]);

            $image_data = $post["images"] ?? [];
            unset($post["images"]);

            $category_exists = LeagueNewsCategory::where('origin_category_id', $category_data["id"])->exists();
            $category_id = 0;

            if (!$category_exists) {
                $category_id = LeagueNewsCategory::insertGetId([
                    'origin_category_id' => $category_data["id"],
                    'name' => $category_data["description"],
                    'type' => $category_data["type"],
                ]);
            } else {
                $category_id = LeagueNewsCategory::where('origin_category_id', $category_data["id"])->first()->id;
            }

            $post_exists = LeagueNews::where('headline', $post["headline"])->exists();
            if ($post_exists) {
                $db_post = LeagueNews::where('headline', $post["headline"])->first();

                // no changes made to post
                if ($db_post->hash === $hash) {
                    continue;
                }

                $db_post->category_id = $category_id;
                $db_post->headline = $post["headline"];
                $db_post->description = $post["description"];
                $db_post->link = $post["link"];
                $db_post->hash = $hash;
                $db_post->updated_at = now();
                $db_post->save();

                LeagueNewsImage::where('post_id', $db_post->id)->delete();

                foreach ($image_data as $sort => $image) {
                    if (!$image) {
                        continue;
                    }

                    LeagueNewsImage::insert([
                        'post_id' => $db_post->id,
                        'link' => $image,
                        'sort' => $sort,
                    ]);
                }
                continue;
            }

            // create post
            $post_id = LeagueNews::insertGetId([
                'season_id' => $season->id,
                'headline' => $post["headline"],
                'description' => $post["description"],
                'link' => $post["link"],
                'category_id' => $category_id,
                'hash' => $hash,
                'created_at' => date('Y-m-d H:i:s', strtotime($post["published"])),
                'updated_at' => date('Y-m-d H:i:s', strtotime($post["lastModified"])),
            ]);

            // create post images
            foreach ($image_data as $sort => $image) {
                if (!$image) {
                    continue;
                }

                LeagueNewsImage::insert([
                    'post_id' => $post_id,
                    'link' => $image,
                    'sort' => $sort,
                ]);
            }
        }

        //Mail::to(env("FPL_ALERT_EMAIL"))->send(new GetLeagueNewsAlert("Admin"));
    }
}
