<?php
require __DIR__ . '/../vendor/autoload.php';

$openWeatherApi = new \OpenWeather\OpenWeatherApi('bd5e378503939ddaee76f12ad7a97608');

echo implode(
        ', ',
        array_map(
            fn(\OpenWeather\Weather $weather) => $weather->main,
            $openWeatherApi->getCurrentWeather(new \OpenWeather\GeoCoordinates(lon: 37.36, lat: 55.45))->weather)
    ) . PHP_EOL;

echo implode(
        ', ',
        array_map(
            fn(\OpenWeather\Weather $weather) => $weather->main,
            $openWeatherApi->getCurrentWeather(new \OpenWeather\GeoCoordinates(lon: -66.159, lat: -68.2008))->weather)
    ) . PHP_EOL;

echo implode(
        ', ',
        array_map(
            fn(\OpenWeather\Weather $weather) => $weather->main,
            $openWeatherApi->getCurrentWeather(new \OpenWeather\GeoCoordinates(lon: 147.794, lat: -31.358))->weather)
    ) . PHP_EOL;