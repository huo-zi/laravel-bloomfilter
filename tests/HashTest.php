<?php

namespace Tests;

use BloomFilter\Hashing;
use PHPUnit\Framework\TestCase;

class HashTest extends TestCase
{
    public function testBasicTest()
    {
        $hash = new Hashing();
        $result = $hash->make('test');
        $this->assertCount(4, $result);
    }

}
