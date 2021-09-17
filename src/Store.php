<?php

namespace BloomFilter;

interface Store
{

    public function set(array $bits);

    public function get(array $bits) : array;
}
