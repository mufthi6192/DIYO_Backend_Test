<?php

namespace App\ServiceLayer\Inventories;

class InventoriesService implements InventoriesServiceInterface{
    protected function responseFormatter(int $code, string $message, bool $status, $data) : array{
        return array([
            'code' => $code,
            'status' => $status,
            'message' => $message,
            'data' => $data
        ]);
    }
    public function addInventory()
    {
        // TODO: Implement addInventory() method.
    }

    public function getInventory(): array
    {
        return $this->responseFormatter(200,"OK",true,"Any");
    }

    public function getInventoryById()
    {
        // TODO: Implement getInventoryById() method.
    }

    public function updateInventory()
    {
        // TODO: Implement updateInventory() method.
    }

    public function deleteInventory()
    {
        // TODO: Implement deleteInventory() method.
    }
}
