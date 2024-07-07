<?php declare(strict_types=1);

namespace OpenWeather;

class Rain
{
    /**
     * @param float|null $h1 Rain volume for the last 1 hour, mm. Please note that only mm as units of measurement are available for this parameter
     * @param float|null $h3 Rain volume for the last 3 hours, mm. Please note that only mm as units of measurement are available for this parameter
     */
    public function __construct(
        public ?float $h1 = null,
        public ?float $h3 = null
    )
    {

    }
}