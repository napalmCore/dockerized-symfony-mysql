<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class OpenWeatherMapController extends AbstractController
{
    private $client;
    private $weatherApiKey;

    public function __construct(HttpClientInterface $client, string $weatherApiKey)
    {
        $this->client = $client;
        $this->weatherApiKey = $weatherApiKey;
    }

    /**
     * @Route("/openweathermap")
     */
    public function index(): Response
    {
        $apiKey = $this->weatherApiKey;
        $city = 'London';
        $url = "https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&mode=xml";

        $response = $this->client->request('GET', $url);
        $statusCode = $response->getStatusCode(); // 200
        // Get XML content
        $content = $response->getContent();
        
        // Convert XML content to array
        $xml = simplexml_load_string($content, "SimpleXMLElement", LIBXML_NOCDATA);

        return $this->render('open_weather_map/index.html.twig', [
            'controller_name' => 'OpenWeatherMapController',
            'weathers' => $xml
        ]);
    }
}