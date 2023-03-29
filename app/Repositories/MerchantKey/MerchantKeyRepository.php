<?php

namespace App\Repositories\MerchantKey;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MerchantKeyRepository implements MerchantKeyRepositoryInterface{

    protected function responseFormatter(string $code, string $message, bool $status, $data) : array{
        return array(
            'code' => $code,
            'status' => $status,
            'message' => $message,
            'data' => $data
        );
    }
    public function addKey(string $key): array
    {

        DB::beginTransaction();

        try {
            $query = DB::table('merchant_keys')->insert([
                'key' => $key,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            if(!$query){
                DB::rollBack();
                throw new \Exception("Failed to insert");
            }else{
                DB::commit();
                return $this->responseFormatter(200,"Successfully insert",true,null);
            }
        }catch (\Throwable $err){
            return $this->responseFormatter(500,$err->getMessage(),false,null);
        }
    }

    public function countKey(string $key): array
    {
        try {
            $query = DB::table('merchant_keys')
                            ->where('key','=',$key)
                            ->count();
            if(!$query){
                throw new \Exception("Failed to count databases");
            }else{
                return $this->responseFormatter(200,"Successfully get data",true,$query);
            }
        }catch (\Throwable $err){
            return $this->responseFormatter(500,$err->getMessage(),false,null);
        }
    }
}
