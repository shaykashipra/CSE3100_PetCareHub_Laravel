<?php

namespace App\Services;

use GuzzleHttp\Client;

class CatApiService {
    protected $client;
    protected $apiKey;

    public function __construct() {
        $this->client = new Client();
        $this->apiKey = env('API_KEY');
    }

    public function fetchBreeds() {
        $response = $this->client->request('GET', 'https://api.thecatapi.com/v1/breeds', [
            'headers' => [
                'x-api-key' => $this->apiKey
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
