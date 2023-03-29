<?php

namespace App\Repositories\Inventories;

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
            $query = DB::table('inventories')->get();
            if(!$query || $query->isEmpty()){
                throw new \Exception("Inventories empty",404);
            }else{
                foreach ($query as $index => $val){
                    $data [] = array(
                        'name' => $val->name,
                        'price' => $val->price,
                        'amount' => $val->amount,
                        'unit' => $val->unit,
                    );
                }

                return $this->responseFormatter(200,"Successfully get inventories",true,$data);
            }
        }catch (\Throwable $err){
            return $this->responseFormatter($err->getCode(),$err->getMessage(),false,null);
        }
    }
}
