# OpenWeather REST API

[![Build Status](https://github.com/xRubin/OpenWeather/workflows/CI/badge.svg)](https://github.com/xRubin/OpenWeather/actions)
[![Latest Stable Version](http://poser.pugx.org/rubin/openweather/v)](https://packagist.org/packages/rubin/openweather)
[![Coverage Status](https://coveralls.io/repos/github/xRubin/OpenWeather/badge.svg?branch=master)](https://coveralls.io/github/xRubin/OpenWeather?branch=master)
[![PHP Version Require](http://poser.pugx.org/rubin/openweather/require/php)](https://packagist.org/packages/rubin/openweather)

PHP implementation for the [OpenWeather](https://openweathermap.org/) REST API.
This library is based on the [REST API docs](https://openweathermap.org/current).

## Installation

With composer:
```bash
composer require rubin/openweather
```

## Usage

Create API connector:
```php
$openWeatherApi = new \OpenWeather\OpenWeatherApi('{key}');
```

Set language (optional):
```php
$openWeatherApi->setLanguage('ru');
```

## Examples

Example script to get current weather:

```php
$openWeatherApi = new \OpenWeather\OpenWeatherApi('{key}');
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
```

Example script to get 5 days forecast:
```php
$openWeatherApi = new \OpenWeather\OpenWeatherApi('{key}');
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
```