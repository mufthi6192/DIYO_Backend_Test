<?php

namespace App\Repositories\ProductVariant;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ProductVariantRepository implements ProductVariantRepositoryInterface{

    protected function responseFormatter(int $code, string $message, bool $status, $data) : array{
        return array(
            'code' => $code,
            'status' => $status,
            'message' => $message,
            'data' => $data
        );
    }
    public function addVariant(string $name, int $price, int $productId): array
    {
        try{
            DB::beginTransaction();
            $query = DB::table('product_variants')->insert([
               'products_id' => $productId,
                'name' => $name,
                'additional_price' => $price,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            if(!$query){
                DB::rollBack();
                throw new \Exception("Failed to insert variant",500);
            }else{
                DB::commit();
                return $this->responseFormatter(201,"Successfully add product_variant",true,null);
            }
        }catch (\Throwable $err){
            return $this->responseFormatter($err->getCode(),$err->getMessage(),false,null);
        }
    }

    public function getVariantById(int $productId)
    {
        // TODO: Implement getVariantById() method.
    }
}
