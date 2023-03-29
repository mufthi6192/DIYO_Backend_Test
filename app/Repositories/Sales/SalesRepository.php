<?php

namespace App\Repositories\Sales;

use App\Models\products;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SalesRepository implements SalesRepositoryInterface{

    protected function responseFormatter(int $code, string $message, bool $status, $data) : array{
        return array(
            'code' => $code,
            'status' => $status,
            'message' => $message,
            'data' => $data
        );
    }
    public function getSaleById($id): array
    {
        try{
            $query = DB::table('sales')->where('id','=',$id)->get();

            if(!$query || $query->isEmpty()){
                throw new \Exception("Failed ! Sales table empty",404);
            }else{

                $total = DB::table('carts')->where('sales_id','=',$id)->get();

                if(!$total || $total->isEmpty()){
                    throw new \Exception("Failed for some issue",500);
                }

                $prod = $total->first();

                $getProduct = products::with(['variants' => function($query) {
                    $query->select('products_id','name', 'additional_price');
                }])->select('id','name', 'description','price')->where('id','=',$prod->product_id)->get();

                $newQuery = $query->first();

                $data = array(
                    'id' => $newQuery->id,
                    'total' => $total->sum('total_price'),
                    'cart' => $getProduct,
                    'created' =>Carbon::parse($newQuery->created_at)->toDayDateTimeString(),
                    'payment_method' => $newQuery->payment_method,
                );

                return $this->responseFormatter(200,"Successfully get data",true,$data);
            }
        }catch (\Throwable $err){
            return $this->responseFormatter($err->getCode(),$err->getMessage(),false,null);
        }
    }


    public function insertSale(string $id, int $total_price, string $payment_method, int $productId): array
    {
        try{
            DB::beginTransaction();
            $query = DB::table('sales')->insert([
               'id' => $id,
                'payment_method' => $payment_method,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            $queryCart = DB::table('carts')->insert([
                'sales_id' => $id,
                'product_id' => $productId,
                'total_price' => $total_price,
            ]);

            if(!$query || !$queryCart){
                DB::rollBack();
                throw new \Exception("Failed to insert database");
            }else{
                DB::commit();
                return $this->responseFormatter(201,"Successfully add",true,null);
            }
        }catch (\Throwable $err){
            DB::rollBack();
            return $this->responseFormatter(500,$err->getMessage(),false,null);
        }
    }


    public function getTotalPrice(int $productId): array
    {
        try{
            $productPrice = DB::table('products')
                ->where('id','=',$productId)
                ->get();

            $variantPrice = DB::table('product_variants')
                                ->where('products_id','=',$productId)
                                ->get();

            if($productPrice->isEmpty()){
                throw new \Exception("Failed ! Product not found");
            }else{
                if($variantPrice->isEmpty()){
                    $totalPrice = $productPrice->sum('price');
                }else{
                    $totalPrice = ($variantPrice->sum('additional_price'))+($productPrice->sum('price'));
                }
                return $this->responseFormatter(200,"Successfully count",true,$totalPrice);
            }
        }catch (\Throwable $err){
            return $this->responseFormatter(500,$err->getMessage(),false,null);
        }
    }
}
