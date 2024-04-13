<?php

namespace App\Services;

use App\Contracts\BrawlDataCombinedInterface;

class BrawDataCombinedService implements BrawlDataCombinedInterface
{
    private $brawlsMerge;
    public function setDataCombined(array $data1, array $data2): array
    {
        $this->brawlsMerge = [];
        if (!empty($brawlApiOfficial) and !empty($brawlApiUnofficial)) {
            foreach($brawlApiOfficial as $object) {
                foreach($brawlApiUnofficial as $object1) {
                    if ($object->id == $object1->id) {
                        $this->brawlsMerge[$object->id] = array_merge(
                            (array) $object1, (array) $object
                        );
                    }
                }
            }
        }
        return $this->brawlsMerge;   
    }
    public function getDataCombined(): array
    {
        return $this->brawlsMerge;
    }
}