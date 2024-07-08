<?php declare(strict_types=1);

namespace OpenWeather;

class Forecast
{
    /**
     * @param int $cnt
     * @param ForecastItem[] $list
     */
    public function __construct(
        public int $cnt,
        public array $list
    )
    {

    }
}