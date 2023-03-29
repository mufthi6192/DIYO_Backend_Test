<?php

namespace App\Repositories\Inventories;

interface InventoriesRepositoryInterface{
    public function addInventory($name,$price,$amount,$unit);
    public function getInventory();
    public function getInventoryById();
    public function updateInventory();
    public function deleteInventory();
}
