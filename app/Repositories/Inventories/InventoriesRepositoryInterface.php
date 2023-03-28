<?php

namespace App\Repositories\Inventories;

interface InventoriesRepositoryInterface{
    public function addInventory();
    public function getInventory();
    public function getInventoryById();
    public function updateInventory();
    public function deleteInventory();
}
