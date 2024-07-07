<?php declare(strict_types=1);

namespace OpenWeather;

class Wind
{
    public function __construct(
        public float $speed,
        public int   $deg,
        public ?float $gust = null
    )
    {

    }
}