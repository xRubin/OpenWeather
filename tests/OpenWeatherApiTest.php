<?php declare(strict_types=1);

namespace tests;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use OpenWeather\CurrentWeather;
use OpenWeather\GeoCoordinates;
use OpenWeather\OpenWeatherApi;
use OpenWeather\Rain;
use OpenWeather\Snow;
use OpenWeather\Weather;
use PHPUnit\Framework\TestCase;

final class OpenWeatherApiTest extends TestCase
{
    public function testCanParseCurrentWeather()
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode([
                'coord' => ['lon' => 37.36, 'lat' => 55.45],
                'weather' => [['id' => 800, 'main' => 'Clear', 'description' => 'clear sky', 'icon' => '01d']],
                'base' => 'stations',
                'main' => ['temp' => 25.13, 'feels_like' => 24.77, 'temp_min' => 24.95, 'temp_max' => 26.23, 'pressure' => 1023, 'humidity' => 41, 'sea_level' => 1023, 'grnd_level' => 1001],
                'visibility' => 10000,
                'wind' => ['speed' => 3, 'deg' => 180],
                'clouds' => ['all' => 0],
                'dt' => 1720359902,
                'sys' => ['type' => 2, 'id' => 2000314, 'country' => 'RU', 'sunrise' => 1720313935, 'sunset' => 1720375903],
                'timezone' => 10800,
                'id' => 473051,
                'name' => 'Vlas’yevo',
                'cod' => 200
            ])),
        ]);

        $openWeatherApi = new OpenWeatherApi('{key}');
        $openWeatherApi->setClient(new Client(['handler' => HandlerStack::create($mock)]));
        $response = $openWeatherApi->getCurrentWeather(new GeoCoordinates(lon: 37.36, lat: 55.45));
        $this->assertInstanceOf(CurrentWeather::class, $response);
        $weather = $response->weather;
        $this->assertIsArray($weather);
        $this->assertContainsOnly(Weather::class, $weather);
        $this->assertEquals(25.13, $response->main->temp);
    }

    public function testCanParseCurrentWeatherRain()
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode([
                'coord' => ['lon' => 147.794, 'lat' => -31.358],
                'weather' => [['id' => 500, 'main' => 'Rain', 'description' => 'light rain', 'icon' => '10d']],
                'base' => 'stations',
                'main' => ['temp' => 11.73, 'feels_like' => 11.31, 'temp_min' => 11.73, 'temp_max' => 11.73, 'pressure' => 1024, 'humidity' => 90, 'sea_level' => 1024, 'grnd_level' => 1002],
                'visibility' => 10000,
                'wind' => ['speed' => 8.73, 'deg' => 51, 'gust' => 16.12],
                'rain' => ['1h' => 0.69],
                'clouds' => ['all' => 100],
                'dt' => 1720389359,
                'sys' => ['country' => 'AU', 'sunrise' => 1720386465, 'sunset' => 1720423177],
                'timezone' => 36000,
                'id' => 2144547,
                'name' => 'Warren Shire',
                'cod' => 200
            ])),
        ]);

        $openWeatherApi = new OpenWeatherApi('{key}');
        $openWeatherApi->setClient(new Client(['handler' => HandlerStack::create($mock)]));
        $response = $openWeatherApi->getCurrentWeather(new GeoCoordinates(lon: 147.794, lat: -31.358));
        $this->assertInstanceOf(CurrentWeather::class, $response);
        $this->assertInstanceOf(Rain::class, $response->rain);
        $this->assertEquals(0.69, $response->snow->h1);
    }

    public function testCanParseCurrentWeatherSnow()
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode([
                'coord' => ['lon' => -66.159, 'lat' => -68.2008],
                'weather' => [['id' => 601, 'main' => 'Snow', 'description' => 'snow', 'icon' => '13n']],
                'base' => 'stations',
                'main' => ['temp' => -18.38, 'feels_like' => -25.38, 'temp_min' => -18.38, 'temp_max' => -18.38, 'pressure' => 985, 'humidity' => 96, 'sea_level' => 985, 'grnd_level' => 804],
                'visibility' => 103,
                'wind' => ['speed' => 12.14, 'deg' => 267, 'gust' => 16.93],
                'snow' => ['1h' => 1.05],
                'clouds' => ['all' => 100],
                'dt' => 1720388654,
                'sys' => ['sunrise' => 1720368297, 'sunset' => 1720371235],
                'timezone' => -10800,
                'id' => 0,
                'name' => '',
                'cod' => 200
            ])),
        ]);

        $openWeatherApi = new OpenWeatherApi('{key}');
        $openWeatherApi->setClient(new Client(['handler' => HandlerStack::create($mock)]));
        $response = $openWeatherApi->getCurrentWeather(new GeoCoordinates(lon: -66.159, lat: -68.2008));
        $this->assertInstanceOf(CurrentWeather::class, $response);
        $this->assertInstanceOf(Snow::class, $response->snow);
        $this->assertEquals(1.05, $response->snow->h1);
    }

    public function testCanOverwriteClient()
    {
        $openWeatherApi = new OpenWeatherApi('{key}');
        $defaultClient = $openWeatherApi->getClient();
        $customClient = $this->createMock(ClientInterface::class);
        $openWeatherApi->setClient($customClient);
        $this->assertInstanceOf($customClient::class, $openWeatherApi->getClient());
        $this->assertNotInstanceOf($defaultClient::class, $openWeatherApi->getClient());
    }

    public function testCanChangeUnits()
    {
        $openWeatherApi = new OpenWeatherApi('{key}');
        $openWeatherApi->setUnits('imperial');
        $this->assertEquals('imperial', $openWeatherApi->getUnits());
    }

    public function testCanChangeLanguage()
    {
        $openWeatherApi = new OpenWeatherApi('{key}');
        $openWeatherApi->setLanguage('ru');
        $this->assertEquals('ru', $openWeatherApi->getLanguage());
    }
}
