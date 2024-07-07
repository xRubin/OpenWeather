<?php declare(strict_types=1);

namespace OpenWeather;

class CurrentWeather
{
    /**
     * @param GeoCoordinates $coord
     * @param Weather[] $weather
     * @param string $base
     * @param MainWeather $main
     * @param int $visibility
     * @param Wind $wind
     */
    public function __construct(
        public GeoCoordinates $coord,
        public array          $weather,
        public string $base,
        public MainWeather $main,
        public int $visibility,
        public Wind $wind,
        public Clouds $clouds,
        public \DateTimeInterface $dt,
        public int $timezone,
        public ?Rain $rain = null,
        public ?Snow $snow = null,
    )
    {
    }
}