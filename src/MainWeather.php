<?php declare(strict_types=1);

namespace OpenWeather;

class MainWeather
{
    public function __construct(
        public float $temp,
        public float $feels_like,
        public float $temp_min,
        public float $temp_max,
        public int   $pressure,
        public int   $humidity,
        public int   $sea_level,
        public int   $grnd_level
    )
    {

    }
}