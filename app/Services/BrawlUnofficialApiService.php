<?php

namespace App\Services;

use App\Contracts\BrawlApiInterface;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BrawlUnofficialApiService implements BrawlApiInterface
{
    protected $method;

    public function getData($method = 'brawlers'): array
    {
        $array = [];
        $this->method = $method;
        
        try {
            $url = env('API_UNOFFICIAL') . $this->method;
            $headers = [];

            $response = Http::get($url, $headers);
            $array = json_decode($response->body())->list;
        } catch (\Exception $error) {
            Log::info('Unofficial:' . $error->getMessage());
        }

        return $array;
    }
}