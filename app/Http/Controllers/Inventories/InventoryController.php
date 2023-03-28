<?php

namespace App\Http\Controllers\Inventories;

use App\Http\Controllers\Controller;
use App\ServiceLayer\Inventories\InventoriesServiceInterface;

class InventoryController extends Controller
{
    private InventoriesServiceInterface $inventoriesService;

    public function __construct(InventoriesServiceInterface $inventoriesService){
        $this->inventoriesService = $inventoriesService;
    }

    public function getInventory(): \Illuminate\Http\JsonResponse
    {
        $response = $this->inventoriesService->getInventory();
        return response()->json($response,200);
    }
}
