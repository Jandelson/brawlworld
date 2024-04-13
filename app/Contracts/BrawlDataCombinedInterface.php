<?php

namespace App\Contracts;

interface BrawlDataCombinedInterface
{
    public function setDataCombined(array $data1, array $data2): array;
    public function getDataCombined(): array;
}