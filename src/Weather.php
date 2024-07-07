<?php declare(strict_types=1);

namespace OpenWeather;

class Weather
{
    public function __construct(
        public int    $id,
        public string $main,
        public string $description,
        public string $icon
    )
    {

    }
}