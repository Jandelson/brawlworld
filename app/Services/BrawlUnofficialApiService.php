<?php

namespace App\Services;

use App\Contracts\BrawlApiInterface;
use Illuminate\Support\Facades\Http;

class BrawlUnofficialApiService implements BrawlApiInterface
{
    protected $method;

    public function getData($method = 'brawlers'): array
    {
        $this->method = $method;
        $url = 'https://api.brawlapi.com/v1/' . $this->method;
        $headers = [];

        $response = Http::get($url, $headers);
        $array = json_decode($response->body())->list;

        return $array;
    }
}