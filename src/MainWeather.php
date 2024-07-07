<?php declare(strict_types=1);

namespace OpenWeather;

class MainWeather
{
    /**
     * @param float $temp Temperature. Unit Default: Kelvin, Metric: Celsius, Imperial: Fahrenheit
     * @param float $feels_like Temperature. This temperature parameter accounts for the human perception of weather. Unit Default: Kelvin, Metric: Celsius, Imperial: Fahrenheit
     * @param float $temp_min Minimum temperature at the moment. This is minimal currently observed temperature (within large megalopolises and urban areas). Unit Default: Kelvin, Metric: Celsius, Imperial: Fahrenheit
     * @param float $temp_max Maximum temperature at the moment. This is maximal currently observed temperature (within large megalopolises and urban areas). Unit Default: Kelvin, Metric: Celsius, Imperial: Fahrenheit
     * @param int $pressure Atmospheric pressure on the sea level, hPa
     * @param int $humidity Humidity, %
     * @param int $sea_level Atmospheric pressure on the sea level, hPa
     * @param int $grnd_level Atmospheric pressure on the ground level, hPa
     */
    public function __construct(
        public float $temp,
        public float $feels_like,
        public float $temp_min,
        public float $temp_max,
        public int   $pressure,
        public int   $humidity,
        public int   $sea_level,
        public int   $grnd_level
    )
    {

    }
}