<?php
require __DIR__ . '/../vendor/autoload.php';

$openWeatherApi = new \OpenWeather\OpenWeatherApi('bd5e378503939ddaee76f12ad7a97608');
$output = new \Symfony\Component\Console\Output\StreamOutput(fopen('php://stdout', 'w'));
$table = new \Symfony\Component\Console\Helper\Table($output);

$table
    ->setHeaders(['DateTime', 'Temperature', 'PoP', 'Weather'])
    ->setRows(array_map(fn(\OpenWeather\ForecastItem $item) => [
        $item->dt->format('Y-m-d H:i:s'),
        $item->main->temp,
        $item->pop,
        $item->weather[0]->description,
    ], $openWeatherApi->getForecast(new \OpenWeather\GeoCoordinates(lon: -66.159, lat: -68.2008))->list));

$table->render();