<?php declare(strict_types=1);

namespace OpenWeather;

class Snow
{
    public function __construct(
        public ?float $h1 = null,
        public ?float $h3 = null
    )
    {

    }
}