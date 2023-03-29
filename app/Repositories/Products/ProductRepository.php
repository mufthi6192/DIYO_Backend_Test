<?php

namespace App\Repositories\Products;

use App\Models\products;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductsRepositoryInterface{
    protected function responseFormatter(int $code, string $message, bool $status, $data) : array{
        return array(
            'code' => $code,
            'status' => $status,
            'message' => $message,
            'data' => $data
        );
    }
    public function addProduct(string $name, string $description, int $price): array
    {
        try {
            DB::beginTransaction();
            $query = DB::table('products')->insert([
                'name' => $name,
                'description' => $description,
                'price' => $price,
            ]);

            if(!$query){
                throw new \Exception("Failed to insert product");
            }else{
                DB::commit();
                return $this->responseFormatter(201,"Successfully add product",true,null);
            }
        }catch (\Throwable $err){
            DB::rollBack();
            return $this->responseFormatter(500,$err->getMessage(),false,null);
        }
    }

    public function getProduct(): array
    {
       try{
           $getProduct = products::with(['variants' => function($query) {
               $query->select('products_id','name', 'additional_price');
           }])->select('id','name', 'description','price')->get();

           if(!$getProduct || $getProduct->isEmpty()){
               throw new \Exception("Failed ! Empty product",404);
           }else{
               return $this->responseFormatter(200,"Successfully get products",true,$getProduct->toArray());
           }
       }catch (\Throwable $err){
           return $this->responseFormatter(404,$err->getMessage(),false,null);
       }
    }
}
