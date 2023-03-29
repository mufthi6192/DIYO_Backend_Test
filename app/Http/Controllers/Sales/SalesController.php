<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\ServiceLayer\Sales\SalesServiceInterface;
use Illuminate\Http\Request;

class SalesController extends Controller
{

    private SalesServiceInterface $salesService;

    public function __construct(SalesServiceInterface $salesService){
        $this->salesService = $salesService;
    }
    public function getSalesById(Request $request,$id): \Illuminate\Http\JsonResponse
    {
        $response = $this->salesService->getSaleById($request,$id);
        return response()->json($response,$response['code']);
    }

    public function insertSale(Request $request): \Illuminate\Http\JsonResponse
    {
        $response = $this->salesService->insertSale($request);
        return response()->json($response,$response['code']);
    }
}
