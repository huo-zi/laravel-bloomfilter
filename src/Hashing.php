<?php
namespace BloomFilter;

class Hashing {

    protected $algos = [
        'crc32',
        'fnv132',
        'adler32',
        'joaat'
    ];

    public function __construct($algos = [])
    {
        $algos AND $this->algos = $algos;
    }

    public function make($string)
    {
        return array_map(function($algo) use ($string) {
            return base_convert(hash($algo, $string), 16, 10) % (1 << 31);
        }, $this->algos);
    }
}