<?php

namespace App\Services;

use App\Contracts\BrawlDataCombinedInterface;
use Illuminate\Support\Facades\Storage;

class BrawlsService
{
    private $fileName = 'braws.json';

    public function __construct(
        private BrawlOfficialApiService $brawlApiOfficial,
        private BrawlUnofficialApiService $brawlApiUnofficial,
        private BrawDataCombinedService $brawDataCombinedService
    ) {}

    public function getData($method = 'brawlers') : object
    {
        $brawlApiOfficial = $this->brawlApiOfficial->getData($method);
        $brawlApiUnofficial = $this->brawlApiUnofficial->getData($method);

        $this->brawDataCombinedService->setDataCombined(
            $brawlApiOfficial,
            $brawlApiUnofficial
        );
        
        $this->createdFileJson($this->brawDataCombinedService);

        return (object) $this->getFileJson();
    }

    private function createdFileJson(BrawlDataCombinedInterface $brawlDataCombinedInterface): void
    {
        $array = $brawlDataCombinedInterface->getDataCombined();
        if (!empty($array)) {
            $contentJson = json_encode($array, true);
            Storage::put($this->fileName, $contentJson);
        }
    }

    private function getFileJson(): array
    {
        $json = Storage::get($this->fileName);
        return json_decode($json, true);
    }
}