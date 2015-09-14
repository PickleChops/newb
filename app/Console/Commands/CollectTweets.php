<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;


/**
 * Class CollectTweets
 * @package App\Console\Commands
 */
class CollectTweets extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'home:collect_tweets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Collect tweets from Twitter';

    /**
     * Off we go
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {

        // I should probably skip the global thing at some point
        define("TWITTER_CONSUMER_KEY", env("TWITTER_CONSUMER_KEY"));
        define("TWITTER_CONSUMER_SECRET", env("TWITTER_CONSUMER_SECRET"));

        // Start streaming thanks Twitter
        $sc = new \App\Lib\QueueRawTweets(env('TWITTER_OAUTH_TOKEN'), env('TWITTER_OAUTH_SECRET'), \Phirehose::METHOD_FILTER);

        //Set a few basics for our stream
        $sc->setLang('en');
        $sc->setLocations(array(array(-10.00, 48.90, 2.50, 60.90)));


        $sc->consume();
    }

}