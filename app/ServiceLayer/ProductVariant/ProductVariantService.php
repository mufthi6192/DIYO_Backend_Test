<?php

namespace App\ServiceLayer\ProductVariant;

use App\Repositories\MerchantKey\MerchantKeyRepositoryInterface;
use App\Repositories\ProductVariant\ProductVariantRepository;
use App\Repositories\ProductVariant\ProductVariantRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductVariantService implements ProductVariantServiceInterface{

    private MerchantKeyRepositoryInterface $merchantKeyRepository;
    private ProductVariantRepositoryInterface $productVariantRepository;

    public function __construct(
        MerchantKeyRepositoryInterface $merchantKeyRepository,
        ProductVariantRepositoryInterface $productVariantRepository,
    ){
        $this->merchantKeyRepository = $merchantKeyRepository;
        $this->productVariantRepository = $productVariantRepository;
    }
    protected function responseFormatter(int $code, string $message, bool $status, $data) : array{
        return array(
            'code' => $code,
            'status' => $status,
            'message' => $message,
            'data' => $data
        );
    }
    public function addVariant(Request $request): array
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
                    $name = $request->input('name');
                    $price = $request->input('price');
                    $productId = $request->input('products_id');

                    $validated = Validator::make($request->all(),[
                        'name' => 'required|string',
                        'price' => 'required|integer',
                        'products_id' => 'required|integer',
                    ]);

                    if($validated->fails()){
                        throw new \Exception($validated->errors(),400);
                    }
                    $addVariant = $this->productVariantRepository->addVariant($name,$price,$productId);

                    if(!$addVariant['status']){
                        throw new \Exception($addVariant['message'],$addVariant['code']);
                    }else{
                        return $this->responseFormatter(201,"Successfully add product variant",true,null);
                    }
                }
            }
        }catch (\Throwable $err){
            return $this->responseFormatter($err->getCode(),$err->getMessage(),false,null);
        }
    }
}
