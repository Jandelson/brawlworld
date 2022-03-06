<?php

namespace App\Services;

use Facade\FlareClient\Stacktrace\File;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class BrawlsService
{
    protected $brawlApiOfficial;
    protected $brawlApiUnofficial;
    private $fileName = 'braws.json';

    public function __construct(
        BrawlOfficialApiService $brawlApiOfficial, 
        BrawlUnofficialApiService $brawlApiUnofficial)
    {
        $this->brawlApiOfficial = $brawlApiOfficial;
        $this->brawlApiUnofficial = $brawlApiUnofficial;
    }

    public function getData($method = 'brawlers') : object
    {
        $brawlApiOfficial = $this->brawlApiOfficial->getData($method);
        $brawlApiUnofficial = $this->brawlApiUnofficial->getData($method);

        $brawlsMerge = [];

        if (!empty($brawlApiOfficial) and !empty($brawlApiUnofficial)) {
            foreach($brawlApiOfficial as $object) {
                foreach($brawlApiUnofficial as $object1) {
                    if ($object->id == $object1->id) {
                        $brawlsMerge[$object->id] = array_merge(
                            (array) $object1, (array) $object
                        );
                    }
                }
            }
        }

        $this->createdFileJson($brawlsMerge);

        return (object) $this->getFileJson();
    }

    private function createdFileJson(array $array)
    {
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