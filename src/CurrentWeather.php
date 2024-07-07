<?php declare(strict_types=1);

namespace OpenWeather;

class CurrentWeather
{
    /**
     * @param GeoCoordinates $coord
     * @param Weather[] $weather
     * @param string $base Internal parameter
     * @param MainWeather $main
     * @param int $visibility Visibility, meter. The maximum value of the visibility is 10 km
     * @param Wind $wind
     * @param Clouds $clouds
     * @param \DateTimeInterface $dt Time of data calculation, unix, UTC
     * @param int $timezone Shift in seconds from UTC
     * @param Rain|null $rain
     * @param Snow|null $snow
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