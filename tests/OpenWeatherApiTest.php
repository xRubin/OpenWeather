<?php declare(strict_types=1);

namespace tests;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use OpenWeather\CurrentWeather;
use OpenWeather\OpenWeatherApi;
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
        $response = $openWeatherApi->getCurrentWeather(new \OpenWeather\GeoCoordinates(lon: 37.36, lat: 55.45));
        $this->assertInstanceOf(CurrentWeather::class, $response);
        $weather = $response->weather;
        $this->assertIsArray($weather);
        $this->assertContainsOnly(Weather::class, $weather);
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
