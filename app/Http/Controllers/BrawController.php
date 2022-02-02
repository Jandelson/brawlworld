<?php

namespace App\Http\Controllers;

use App\Services\BrawlsService;

class BrawController extends Controller
{
    public function index(BrawlsService $brawlsService)
    {
        $brawls = $brawlsService->getData();

        return view('brawls.index', [
            'data' => $brawls
        ]);
    }
}
