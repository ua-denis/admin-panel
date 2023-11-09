<?php

namespace App\Services;

use App\Contracts\RandomlyImageServiceInterface;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class UnsplashService implements RandomlyImageServiceInterface
{
    private string $baseUrl;
    private string $accessKey;

    public function __construct()
    {
        $this->baseUrl  = config('unsplash.api_base_url');
        $this->accessKey = config('unsplash.access_key');
    }

    public function getRandomImage()
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Client-ID ' . $this->accessKey,
            ])->get($this->baseUrl . 'photos/random');

            return $response->json()['urls']['small'];
        }
        catch (RequestException $e) {
            Log::error('Unsplash API request failed: ' . $e->getMessage());
            return null;
        }
    }
}