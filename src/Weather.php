<?php declare(strict_types=1);

namespace OpenWeather;

class Weather
{
    /**
     * @param int $id Weather condition id
     * @param string $main Group of weather parameters (Rain, Snow, Clouds etc.)
     * @param string $description Weather condition within the group.
     * @param string $icon
     */
    public function __construct(
        public int    $id,
        public string $main,
        public string $description,
        public string $icon
    )
    {

    }
}