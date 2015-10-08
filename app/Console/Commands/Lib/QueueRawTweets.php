<?php
/**
 * Created by PhpStorm.
 * User: bstratton
 * Date: 15/03/2014
 * Time: 20:28
 */

namespace App\Console\Commands\Lib;

use App\Jobs\TweetJob;
use Laravel\Lumen\Routing\DispatchesJobs;


class QueueRawTweets extends \OauthPhirehose
{

    use DispatchesJobs;

    /**
     * Enqueue each tweet with hashtags
     *
     * @param string $status
     */
    public function enqueueStatus($status)
    {

        $data = json_decode($status, true);

        //Queue up Tweets with Hashtags
        if (is_array($data) && isset($data['entities']['hashtags']) && count($data['entities']['hashtags'])) {
            $this->dispatch(new TweetJob($data));
        }

    }
}

