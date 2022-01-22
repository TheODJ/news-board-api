<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\News;

class DailyUpvotesReset extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zero_upvotes:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset upvotes count to zero everyday on all posts';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $news = News::all();
        foreach ($news as $news_item) {
            $news_item->no_upvotes = 0;
            $news_item->save();
        }

        $this->info('Successfully reset upvotes count on all posts for the day');
    }
}
