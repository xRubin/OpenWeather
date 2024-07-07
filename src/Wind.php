<?php declare(strict_types=1);

namespace OpenWeather;

class Wind
{
    /**
     * @param float $speed Wind speed. Unit Default: meter/sec, Metric: meter/sec, Imperial: miles/hour
     * @param int $deg Wind direction, degrees (meteorological)
     * @param float|null $gust Wind gust. Unit Default: meter/sec, Metric: meter/sec, Imperial: miles/hour
     */
    public function __construct(
        public float $speed,
        public int   $deg,
        public ?float $gust = null
    )
    {

    }
}