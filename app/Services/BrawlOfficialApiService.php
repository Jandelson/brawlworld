<?php

namespace App\Services;

use App\Contracts\BrawlApiInterface;
use Illuminate\Support\Facades\Http;

class BrawlOfficialApiService implements BrawlApiInterface
{
    protected $method;

    public function getData($method = 'brawlers'): array
    {
        $this->method = $method;
        $url = 'https://api.brawlstars.com/v1/' . $this->method;

        $token = env('TOKEN_API_BRAWLSTAR');

        $headers = [
            'Authorization' => 'Bearer ' . $token,        
            'Accept'        => 'application/json',
        ];

        try {
            $response = Http::get($url, $headers);
            $array = json_decode($response->body())->items;
        } catch (\Exception $error) {
            return [];
        }
        return $array;
    }
}