<?php

namespace App\Contracts;

interface BrawlApiInterface
{
    public function getData($method): array;
}