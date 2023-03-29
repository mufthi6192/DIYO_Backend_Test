<?php

namespace App\Http\Controllers\MerchantKey;

use App\Http\Controllers\Controller;
use App\ServiceLayer\MerchantKey\MerchantKeyServiceInterface;
use Illuminate\Http\Request;

class MerchantKeyController extends Controller
{
    private MerchantKeyServiceInterface $merchantKeyService;

    public function __construct(MerchantKeyServiceInterface $merchantKeyService){
        $this->merchantKeyService = $merchantKeyService;
    }

    public function addKey(Request $request): \Illuminate\Http\JsonResponse
    {
        $response = $this->merchantKeyService->addKey($request);
        return response()->json($response,$response['code']);
    }
}
