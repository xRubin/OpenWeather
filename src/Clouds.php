<?php declare(strict_types=1);

namespace OpenWeather;

class Clouds
{
    /**
     * @param int $all Cloudiness, %
     */
    public function __construct(
        public int $all
    )
    {

    }
}