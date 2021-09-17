<?php

namespace BloomFilter;

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Manager;

class BloomFilter extends Manager
{

    /**
     * @var \App\Support\BloomFilter\Hashing
     */
    private $hash;

    public function __construct($hash)
    {
        $this->hash = $hash;
    }

    public function add($string)
    {
        $this->driver()->set($this->hash->make($string));
    }

    public function has($string) : bool
    {
        $result = $this->driver()->get($this->hash->make($string));
        return count($result) == array_sum($result);
    }

    public function getDefaultDriver()
    {
        return $this->config('default', 'redis');
    }

    public function createRedisDriver()
    {
        $name = $this->config('stores.redis.name');
        return new RedisStore(Redis::connection($name));
    }

    /**
     * @return \App\Support\BloomFilter\Store
     */
    public function driver($driver = null)
    {
        return parent::driver($driver);
    }

    public function config($key, $default = null)
    {
        return config('bloomfilter.' . $key, $default);
    }
}
