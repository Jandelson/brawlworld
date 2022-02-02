<?php

namespace App\Services;

class BrawlsService
{
    protected $brawlApiOfficial;
    protected $brawlApiUnofficial;

    public function __construct(
        BrawlOfficialApiService $brawlApiOfficial, 
        BrawlUnofficialApiService $brawlApiUnofficial)
    {
        $this->brawlApiOfficial = $brawlApiOfficial;
        $this->brawlApiUnofficial = $brawlApiUnofficial;
    }

    public function getData($method = 'brawlers') : object
    {
        $this->brawlApiOfficial->getData($method);
        $this->brawlApiUnofficial->getData($method);

        $brawlsMerge = [];

        foreach($this->brawlApiOfficial->getData($method) as $object) {
            foreach($this->brawlApiUnofficial->getData($method) as $object1) {
                if ($object->id == $object1->id) {
                    $brawlsMerge[$object->id] = array_merge(
                        (array) $object1, (array) $object
                    );
                }
            }
        }

        return (object) $brawlsMerge;
    }
}