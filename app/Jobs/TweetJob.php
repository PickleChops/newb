<?php

namespace App\Jobs;

use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;


class TweetJob extends Job implements SelfHandling, ShouldQueue
{

    private $data;
    private $createdTime;

    /**
     * Create a new job instance.
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
        $this->createdTime = time();
    }

    /**
     * Process the job
     * @param \App\Lib\HashTags $hashTags
     */
    public function handle(\App\Lib\HashTags $hashTags)
    {
        $bucketName = $hashTags->getBucketName($this->createdTime);

        $tags = $hashTags->getHashTags($this->data);

        foreach ($tags as $tag) {
            $hashTags->addTagToBucket($bucketName, $tag);
            echo "Incremented tag: {$tag} in set {$bucketName}\n";
        }
    }
}