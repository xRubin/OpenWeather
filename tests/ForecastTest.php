<?php declare(strict_types=1);

namespace tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use OpenWeather\CurrentWeather;
use OpenWeather\Forecast;
use OpenWeather\ForecastItem;
use OpenWeather\GeoCoordinates;
use OpenWeather\OpenWeatherApi;
use OpenWeather\Weather;
use PHPUnit\Framework\TestCase;

final class ForecastTest extends TestCase
{
    public function testCanParseForecast()
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode([
                    'cod' => '200',
                    'message' => 0,
                    'cnt' => 40,
                    'list' => [
                        [
                            'dt' => 1720450800,
                            'main' => ['temp' => -24.57, 'feels_like' => -31.57, 'temp_min' => -24.57, 'temp_max' => -24.57, 'pressure' => 1001, 'sea_level' => 1001, 'grnd_level' => 813, 'humidity' => 82, 'temp_kf' => 0],
                            'weather' => [['id' => 804, 'main' => 'Clouds', 'description' => 'overcast clouds', 'icon' => '04n']],
                            'clouds' => ['all' => 90],
                            'wind' => ['speed' => 3.72, 'deg' => 263, 'gust' => 3.66],
                            'visibility' => 10000,
                            'pop' => 0,
                            'sys' => ['pod' => 'n'],
                            'dt_txt' => '2024-07-08 15:00:00'
                        ]
                    ],
                    'city' => [
                        'id' => 0,
                        'name' => '',
                        'coord' => ['lat' => -68.2008, 'lon' => -66.159],
                        'country' => '',
                        'population' => 0,
                        'timezone' => -10800,
                        'sunrise' => 1720454087,
                        'sunset' => 1720458263
                    ]
                ]
            )),
        ]);

        $openWeatherApi = new OpenWeatherApi('{key}');
        $openWeatherApi->setClient(new Client(['handler' => HandlerStack::create($mock)]));
        $response = $openWeatherApi->getForecast(new GeoCoordinates(lon: -66.159, lat: -68.2008));
        $this->assertInstanceOf(Forecast::class, $response);
        $this->assertContainsOnly(ForecastItem::class, $response->list);
    }
}
