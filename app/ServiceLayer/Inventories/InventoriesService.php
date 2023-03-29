<?php

namespace App\ServiceLayer\Inventories;

use App\Repositories\Inventories\InventoriesRepositoryInterface;
use App\Repositories\MerchantKey\MerchantKeyRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InventoriesService implements InventoriesServiceInterface{

    private MerchantKeyRepositoryInterface $merchantKeyRepository;
    private InventoriesRepositoryInterface $inventoriesRepository;

    public function __construct(
        MerchantKeyRepositoryInterface $merchantKeyRepository,
        InventoriesRepositoryInterface $inventoriesRepository
    )
    {
        $this->merchantKeyRepository = $merchantKeyRepository;
        $this->inventoriesRepository = $inventoriesRepository;
    }

    protected function responseFormatter(int $code, string $message, bool $status, $data) : array{
        return array(
            'code' => $code,
            'status' => $status,
            'message' => $message,
            'data' => $data
        );
    }
    public function addInventory(Request $request): array
    {
        $name = $request->input('name');
        $price = $request->input('price');
        $amount = $request->input('amount');
        $unit = $request->input('unit');

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
                    $validated = Validator::make($request->all(),[
                       'name' => 'required|string',
                        'price' => 'required|integer',
                        'amount' => 'required|integer',
                        'unit' => 'required|string'
                    ]);

                    if($validated->fails()){
                        throw new \Exception($validated->errors(),400);
                    }else{
                        $insert = $this->inventoriesRepository->addInventory($name,$price,$amount,$name);

                        if(!$insert['status']){
                            throw new \Exception($insert['message'],$insert['code']);
                        }else{
                            return $this->responseFormatter(201,"Successfully add inventories",true,null);
                        }
                    }
                }
            }

        }catch (\Throwable $err){
            return $this->responseFormatter($err->getCode(),$err->getMessage(),false,null);
        }
    }

    public function getInventory(Request $request): array
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
                    $getInventory = $this->inventoriesRepository->getInventory();

                    if(!$getInventory['status']){
                        throw new \Exception($getInventory['message'],$getInventory['code']);
                    }else{
                        return $this->responseFormatter(200,"Successfully get inventories",true,$getInventory['data']);
                    }
                }
            }

        }catch (\Throwable $err){
            return $this->responseFormatter($err->getCode(),$err->getMessage(),false,null);
        }
    }

    public function getInventoryById(Request $request)
    {
        // TODO: Implement getInventoryById() method.
    }

    public function updateInventory(Request $request)
    {
        // TODO: Implement updateInventory() method.
    }

    public function deleteInventory(Request $request)
    {
        // TODO: Implement deleteInventory() method.
    }
}
