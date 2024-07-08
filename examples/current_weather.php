<?php
require __DIR__ . '/../vendor/autoload.php';

$openWeatherApi = new \OpenWeather\OpenWeatherApi('bd5e378503939ddaee76f12ad7a97608');
$output = new \Symfony\Component\Console\Output\StreamOutput(fopen('php://stdout', 'w'));
$table = new \Symfony\Component\Console\Helper\Table($output);

$table
    ->setHeaders(['Latitude', 'Longitude', 'Temperature', 'Weather'])
    ->setRows(array_map(function (\OpenWeather\GeoCoordinates $coordinates) use ($openWeatherApi) {
        $current = $openWeatherApi->getCurrentWeather($coordinates);
        return [
            $coordinates->lat,
            $coordinates->lon,
            $current->main->temp,
            $current->weather[0]->description
        ];
    }, [
        new \OpenWeather\GeoCoordinates(lon: 37.36, lat: 55.45),
        new \OpenWeather\GeoCoordinates(lon: -66.159, lat: -68.2008),
        new \OpenWeather\GeoCoordinates(lon: 147.794, lat: -31.358)
    ]));

$table->render();