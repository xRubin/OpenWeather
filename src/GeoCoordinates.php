<?php declare(strict_types=1);

namespace OpenWeather;

class GeoCoordinates
{
    public function __construct(
        public float $lon,
        public float $lat,
    )
    {

    }
}