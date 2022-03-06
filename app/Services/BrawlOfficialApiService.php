<?php

namespace App\Services;

use App\Contracts\BrawlApiInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BrawlOfficialApiService implements BrawlApiInterface
{
    protected $method;

    public function getData($method = 'brawlers'): array
    {
        $array = [];
        $this->method = $method;
        $url = 'https://api.brawlstars.com/v1/' . $this->method;

        $token = env('TOKEN_API_BRAWLSTAR');

        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept'        => 'application/json',
        ];

        try {
            $response = Http::get($url, $headers);
            $body = json_decode($response->body());
            if (!isset($body->items)) {
                Log::info('Official:' . $body->message);
            }
            $array = $body->items;
        } catch (\Exception $error) {
            Log::info('Official:' . $error->getMessage());
        }
        return $array;
    }
}