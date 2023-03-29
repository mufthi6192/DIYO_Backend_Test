<?php

namespace App\ServiceLayer\Inventories;


use Illuminate\Http\Request;

interface InventoriesServiceInterface{
    public function addInventory(Request $request);
    public function getInventory(Request $request);
    public function getInventoryById(Request $request);
    public function updateInventory(Request $request);
    public function deleteInventory(Request $request);
}
