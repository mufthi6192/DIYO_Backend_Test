<?php

namespace App\ServiceLayer\Products;

use App\Repositories\MerchantKey\MerchantKeyRepositoryInterface;
use App\Repositories\Products\ProductRepository;
use App\Repositories\Products\ProductsRepositoryInterface;
use App\Repositories\ProductVariant\ProductVariantRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductsService implements ProductsServiceInterface{

    private MerchantKeyRepositoryInterface $merchantKeyRepository;
    private ProductsRepositoryInterface $productsRepository;

    public function __construct(
        MerchantKeyRepositoryInterface $merchantKeyRepository,
        ProductsRepositoryInterface $productsRepository,
    ){
        $this->merchantKeyRepository = $merchantKeyRepository;
        $this->productsRepository = $productsRepository;
    }
    protected function responseFormatter(int $code, string $message, bool $status, $data) : array{
        return array(
            'code' => $code,
            'status' => $status,
            'message' => $message,
            'data' => $data
        );
    }
    public function addProduct(Request $request): array
    {
        try{
            $name = $request->input('name');
            $description = $request->input('description');
            $price = $request->input('price');

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
                        'description' => 'required|string',
                        'price' => 'required|integer'
                    ]);

                    if($validated->fails()){
                        throw new \Exception($validated->errors(),400);
                    }else{
                        $insertProduct = $this->productsRepository->addProduct($name,$description,$price);

                        if(!$insertProduct['status']){
                            throw new \Exception($insertProduct['code'],$insertProduct['message'],false,null);
                        }
                        return $this->responseFormatter(201,"Successfully add product",false,null);
                    }
                }
            }
        }catch (\Throwable $err){
            return $this->responseFormatter($err->getCode(),$err->getMessage(),false,null);
        }
    }

    public function getProduct(Request $request): array
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
                    $getProduct = $this->productsRepository->getProduct();

                    if(!$getProduct['status']){
                        throw new \Exception($getProduct['message'],$getProduct['code']);
                    }else{
                        return $this->responseFormatter(200,"Successfully get inventories",true,$getProduct['data']);
                    }
                }
            }

        }catch (\Throwable $err){
            return $this->responseFormatter($err->getCode(),$err->getMessage(),false,null);
        }
    }

    public function getProductById()
    {
        // TODO: Implement getProductById() method.
    }

    public function updateProduct()
    {
        // TODO: Implement updateProduct() method.
    }

    public function deleteProduct()
    {
        // TODO: Implement deleteProduct() method.
    }
}
