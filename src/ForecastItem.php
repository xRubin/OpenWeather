<?php declare(strict_types=1);

namespace OpenWeather;

class ForecastItem
{
    /**
     * @param \DateTimeInterface $dt Time of data forecasted, unix, UTC
     * @param MainWeather $main
     * @param Weather[] $weather
     * @param Clouds $clouds
     * @param Wind $wind
     * @param int $visibility Average visibility, metres. The maximum value of the visibility is 10km
     * @param float $pop Probability of precipitation. The values of the parameter vary between 0 and 1, where 0 is equal to 0%, 1 is equal to 100%
     * @param Rain|null $rain
     * @param Snow|null $snow
     */
    public function __construct(
        public \DateTimeInterface $dt,
        public MainWeather        $main,
        public array              $weather,
        public Clouds             $clouds,
        public Wind               $wind,
        public int                $visibility,
        public float              $pop,
        public ?Rain              $rain = null,
        public ?Snow              $snow = null,
    )
    {

    }
}