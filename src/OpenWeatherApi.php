<?php declare(strict_types=1);

namespace OpenWeather;

use CuyZ\Valinor\Mapper\Source\Source;
use CuyZ\Valinor\MapperBuilder;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

class OpenWeatherApi
{
    private ?ClientInterface $client = null;

    /**
     * @param string $appId
     */
    public function __construct(
        private readonly string $appId,
        private string          $units = 'metric',
        private string          $language = 'en'
    )
    {
    }

    public function getUnits(): string
    {
        return $this->units;
    }

    public function setUnits(string $units): OpenWeatherApi
    {
        $this->units = $units;
        return $this;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function setLanguage(string $language): OpenWeatherApi
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @param ClientInterface|null $client
     * @return void
     */
    public function setClient(?ClientInterface $client): void
    {
        $this->client = $client;
    }

    /**
     * @return ClientInterface
     */
    public function getClient(): ClientInterface
    {
        if (null === $this->client) {
            $this->client = new Client(['base_uri' => 'https://api.openweathermap.org/']);
        }
        return $this->client;
    }

    public function getCurrentWeather(GeoCoordinates $coordinates): CurrentWeather
    {
        $response = $this->getClient()->request('GET', '/data/2.5/weather', [
            'query' => [
                'lat' => $coordinates->lat,
                'lon' => $coordinates->lon,
                'appid' => $this->appId,
                'units' => $this->getUnits(),
                'lang' => $this->getLanguage(),
            ],
        ]);

        return (new MapperBuilder())
            ->allowSuperfluousKeys()
            ->mapper()
            ->map(
                CurrentWeather::class,
                Source::json((string)$response->getBody())
                    ->map([
                        '1h' => 'h1',
                        '3h' => 'h3',
                    ])
            );
    }
}