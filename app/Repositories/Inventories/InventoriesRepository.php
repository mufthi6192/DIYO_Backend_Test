<?php

namespace App\Repositories\Inventories;

use App\Models\products;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InventoriesRepository implements InventoriesRepositoryInterface{

    protected function responseFormatter(int $code, string $message, bool $status, $data) : array{
        return array(
            'code' => $code,
            'status' => $status,
            'message' => $message,
            'data' => $data
        );
    }
    public function addInventory($name,$price,$amount,$unit): array
    {
        try{
            DB::beginTransaction();

            $response = DB::table('inventories')->insert([
               'name' => $name,
                'price' => $price,
                'amount' => $amount,
                'unit' => $unit
            ]);

            if(!$response){
                throw new \Exception("Failed to insert inventories");
            }else{
                DB::commit();
                return $this->responseFormatter(201,"Successfully insert inventories",true,null);
            }
        }catch (\Throwable $err){
            DB::rollBack();
            return $this->responseFormatter($err->getCode(),$err->getMessage(),false,null);
        }
    }

    public function getInventory()
    {
        try{
            $products = products::with('product_variants')->get();
            $data = $products->map(function($product) {
                return array(
                    'id' => $product->id,
                    'name' => $product->name,
                    'description' => $product->description,
                    'variants' => $product->product_variants->toArray(),
                );
            });
        }catch (\Throwable $err){
            return $this->responseFormatter($err->getCode(),$err->getMessage(),false,null);
        }
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
