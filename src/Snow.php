<?php declare(strict_types=1);

namespace OpenWeather;

class Snow
{
    /**
     * @param float|null $h1 Snow volume for the last 1 hour, mm. Please note that only mm as units of measurement are available for this parameter
     * @param float|null $h3 Snow volume for the last 3 hours, mm. Please note that only mm as units of measurement are available for this parameter
     */
    public function __construct(
        public ?float $h1 = null,
        public ?float $h3 = null
    )
    {

    }
}