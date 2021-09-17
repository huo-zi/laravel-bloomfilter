<?php

namespace BloomFilter;

class RedisStore implements Store
{

    /**
     * @var \Redis
     */
    private $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function set(array $bits)
    {
        $pipline = $this->client->pipeline();
        foreach ($bits as $bit) {
            $pipline->setbit(config('bloomfilter.stores.redis.key'), $bit, 1);
        }
        $pipline->execute();
    }

    public function get(array $bits): array
    {
        $pipline = $this->client->pipeline();
        foreach ($bits as $bit) {
            $pipline->getbit(config('bloomfilter.stores.redis.key'), $bit);
        }
        return $pipline->execute();
    }
}
