<?php

namespace App\Http\Controllers\Inventories;

use App\Http\Controllers\Controller;
use App\ServiceLayer\Inventories\InventoriesServiceInterface;
use Illuminate\Http\Request;


class InventoryController extends Controller
{
    private InventoriesServiceInterface $inventoriesService;

    public function __construct(InventoriesServiceInterface $inventoriesService){
        $this->inventoriesService = $inventoriesService;
    }

    public function getInventory(Request $request): \Illuminate\Http\JsonResponse
    {
        $response = $this->inventoriesService->getInventory($request);
        return response()->json($response,$response['code']);
    }

    public function addInventory(Request $request): \Illuminate\Http\JsonResponse
    {
        $response = $this->inventoriesService->addInventory($request);
        return response()->json($response,$response['code']);
    }
}
