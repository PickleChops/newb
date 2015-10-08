<?php

namespace App\Http\Controllers\Xhr;

use App\Http\Controllers\Controller;

class TagsXhr extends Controller
{
    private $redis;
    private $hashTags;

    /**
     * @param \Predis\Client $redisConnection
     * @param \App\Lib\HashTags $hashTags
     */
    public function __construct(\Predis\Client $redisConnection, \App\Lib\HashTags $hashTags)
    {
        $this->redis = $redisConnection;
        $this->hashTags = $hashTags;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $time = time();
        $response = $this->getTagsAndCounts(1443962970, 1443963040, 10);
        return response()->json($response);
    }

    /**
     * @param $startTime
     * @param $endTime
     * @param $limit
     * @return array
     */
    private function getTagsAndCounts($startTime, $endTime, $limit)
    {
        $requiredBuckets = $this->hashTags->getBucketNamesForTimeRange($startTime, $endTime);

        $totals = $this->hashTags->createTotals("Totals:$startTime:$endTime:$limit", $requiredBuckets, $limit);

        return $totals;
    }
}
