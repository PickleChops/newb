<?php
/**
 * Created by PhpStorm.
 * User: bstratton
 * Date: 15/03/2014
 * Time: 20:28
 */

namespace App\Lib;

use Queue;


class QueueRawTweets extends \OauthPhirehose
{

    static $tweetCount = 0;


    /**
     * Enqueue each status
     *
     * @param string $status
     */
    public function enqueueStatus($status)
    {
        /*
     * In this simple example, we will just display to STDOUT rather than enqueue.
     * NOTE: You should NOT be processing tweets at this point in a real application, instead they should be being
     *       enqueued and processed asyncronously from the collection process.
     */
        $data = json_decode($status, true);

        die(print_r($data,true));

        if (is_array($data) && isset($data['user']['screen_name'])) {
            print $data['user']['screen_name'] . ': ' . urldecode($data['text']) . "\n";
        }

    }
}

