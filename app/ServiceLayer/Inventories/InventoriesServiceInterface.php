<?php

namespace App\ServiceLayer\Inventories;

interface InventoriesServiceInterface{
    public function addInventory();
    public function getInventory();
    public function getInventoryById();
    public function updateInventory();
    public function deleteInventory();
}
