<?php

namespace App\ServiceLayer\Sales;

use App\Repositories\MerchantKey\MerchantKeyRepositoryInterface;
use App\Repositories\Sales\SalesRepository;
use App\Repositories\Sales\SalesRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SalesService implements SalesServiceInterface{

    private MerchantKeyRepositoryInterface $merchantKeyRepository;
    private SalesRepositoryInterface $salesRepository;

    public function __construct(
        MerchantKeyRepositoryInterface $merchantKeyRepository,
        SalesRepositoryInterface $salesRepository,
    ){
        $this->merchantKeyRepository = $merchantKeyRepository;
        $this->salesRepository = $salesRepository;
    }
    protected function responseFormatter(int $code, string $message, bool $status, $data) : array{
        return array(
            'code' => $code,
            'status' => $status,
            'message' => $message,
            'data' => $data
        );
    }
    public function getSaleById(Request $request,$id): array
    {
        try {
            $key = $request->query('key');
            if(empty($key) || is_null($key)){
                throw new \Exception("Unauthorized Access",400);
            }
            $countKey = $this->merchantKeyRepository->countKey($key);

            if(!$countKey['status']){
                throw new \Exception('Unauthorized Access',400);
            }else{
                if($countKey['data'] < 1){
                    throw new \Exception("Unauthorized Access",400);
                }else{
                    $data = $this->salesRepository->getSaleById($id);
                    if(!$data['status']){
                        throw new \Exception($data['message'],$data['code']);
                    }else{
                        return $this->responseFormatter(200,"Successfully get sales data",true,$data['data']);
                    }
                }
            }
        }catch(\Throwable $err){
            return $this->responseFormatter($err->getCode(),$err->getMessage(),false,null);
        }
    }


    public function insertSale(Request $request): array
    {
        try{
            $key = $request->query('key');
            if(empty($key) || is_null($key)){
                throw new \Exception("Unauthorized Access",400);
            }
            $countKey = $this->merchantKeyRepository->countKey($key);

            if(!$countKey['status']){
                throw new \Exception('Unauthorized Access',400);
            }else{
                if($countKey['data'] < 1){
                    throw new \Exception("Unauthorized Access",400);
                }else{

                    $validated = Validator::make($request->all(),[
                       'id' => 'required|string',
                       'product_id' => 'required|integer|exists:products,id',
                       'payment_method' => 'required|string',
                    ]);

                    if($validated->fails()){
                        throw new \Exception($validated->errors(),400);
                    }

                    $totalPrice = $this->salesRepository->getTotalPrice($request->input('product_id'));

                    if(!$totalPrice['status']){
                        throw new \Exception($totalPrice['message'],$totalPrice['code']);
                    }
                    else{
                        $insertSales = $this->salesRepository->insertSale($request->input('id'),$totalPrice['data'],$request->input('payment_method'),$request->input('product_id'));
                        if(!$insertSales['status']){
                            throw new \Exception($insertSales['message'],$insertSales['code']);
                        }else{
                            return $this->responseFormatter(200,"Successfully insert sales data",true,$totalPrice['data']);
                        }
                    }
                }
            }
        }catch (\Throwable $err){
            return $this->responseFormatter($err->getCode(),$err->getMessage(),false,null);
        }
    }
}
