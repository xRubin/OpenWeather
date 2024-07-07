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
$openWeatherApi = new \OpenWeather\OpenWeather('{key}');
```

Set language (optional):
```php
$openWeatherApi->setLanguage('ru');
```

## Examples

Example query to get current weather:

```php
$openWeatherApi = new \OpenWeather\OpenWeatherApi('{key}');

echo implode(
    ', ',
    array_map(
        fn(\OpenWeather\Weather $weather) => $weather->description,
        $openWeatherApi->getCurrentWeather(new \OpenWeather\GeoCoordinates(lon: 37.36, lat: 55.45))->weather)
) . PHP_EOL;
```