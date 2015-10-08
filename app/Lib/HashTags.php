<?php

namespace App\Lib;

use Predis\Collection\Iterator;


/**
 * User: bstratton
 * Date: 03/10/15
 * Time: 23:20
 */
class HashTags
{

    const TAG_KEY_PREFIX = 'T:';
    const BUCKET_FREQUECY = 10;

    private $redis;

    /**
     * @param \Predis\Client $redisConnection
     */
    public function __construct(\Predis\Client $redisConnection)
    {
        $this->redis = $redisConnection;
    }

    /**
     * @param $time
     * @param $bucketSize
     * @return mixed
     */
    private function floorTimeBucket($time, $bucketSize)
    {
        return $time - ($time % $bucketSize);
    }

    /**
     * Return the bucketname for a given time
     * @param $time
     * @return string
     */
    public function getBucketName($time)
    {
        return self::TAG_KEY_PREFIX . $this->getBucketTime($time);
    }

    /**
     * Get the bucket time for a given time
     * @param $time
     * @return mixed
     */
    public function getBucketTime($time)
    {
        return $this->floorTimeBucket($time, self::BUCKET_FREQUECY);
    }

    /**
     * @param $bucketName
     * @param $tag
     * @return string
     */
    public function addTagToBucket($bucketName, $tag)
    {
        return $this->redis->zincrby($bucketName, 1, $tag);
    }


    /**
     * Extract HashTags from Tweet data
     * @param $tweetData
     * @return array
     */
    public function getHashTags($tweetData)
    {
        $tagsData = array_get($tweetData, 'entities.hashtags', []);
        $justText = array_pluck($tagsData, 'text');
        return $justText;
    }

    /**
     * Return the buckets that hold the tags for the time range specified
     * @param $startTime
     * @param $endTime
     * @return array
     */
    public function getBucketNamesForTimeRange($startTime, $endTime)
    {
        $startBucketTime = $this->getBucketTime($startTime);
        $endBucketTime = $this->getBucketTime($endTime);

        //@todo This can be optimized to avoid scanning all buckets, by building a better pattern based on the time range
        $tagBuckets = $this->scanForKeys(self::TAG_KEY_PREFIX . "*");

        $inRange = [];
        foreach ($tagBuckets as $tagBucket) {

            $bucketTime = (int)substr($tagBucket, strlen(self::TAG_KEY_PREFIX));

            if ($bucketTime >= $startBucketTime && $bucketTime < $endBucketTime) {
                $inRange[] = $tagBucket;
            }

        }

        return $inRange;

    }

    /**
     * @param $name
     * @param $buckets
     * @param null $limit
     * @return array
     */
    public function createTotals($name, $buckets, $limit = null)
    {

        $data = [];

        if (count($buckets)) {
            $this->redis->zunionstore($name, $buckets);

            $data = $this->redis->zrevrange($name, 0, $limit === null ? -1 : $limit - 1, ['WITHSCORES' => true]);
        }
        return $data;
    }

    /**
     * @param $pattern
     * @return array
     */
    private function scanForKeys($pattern)
    {

        $keys = [];

        foreach (new Iterator\Keyspace($this->redis, $pattern) as $key) {
            $keys[] = $key;
        }

        return $keys;
    }

}