<?php

namespace App\ServiceLayer\MerchantKey;

use App\Repositories\MerchantKey\MerchantKeyRepositoryInterface;
use http\Env\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MerchantKeyService implements MerchantKeyServiceInterface{

    private MerchantKeyRepositoryInterface $merchantKeyRepository;

    public function __construct(MerchantKeyRepositoryInterface $merchantKeyRepository){
        $this->merchantKeyRepository = $merchantKeyRepository;
    }
    protected function responseFormatter(string $code, string $message, bool $status, $data) : array{
        return array(
            'code' => $code,
            'status' => $status,
            'message' => $message,
            'data' => $data
        );
    }
    public function addKey(Request|\Illuminate\Http\Request $request): array
    {
        $key = $request->input('merchant_key');

        try{
            $validated = Validator::make($request->all(),[
                'merchant_key' => 'required|string|max:255'
            ]);

            if($validated->fails()){
                throw new \Exception($validated->errors(),400);
            }else{
                $insert = $this->merchantKeyRepository->addKey($key);
                if(!$insert['status']){
                    throw new \Exception("Failed to add merchant key ! Please try again",$insert['code']);
                }else{
                    return $this->responseFormatter(201,"Successfully create Merchant Key",true,null);
                }
            }
        }catch (\Throwable $err){
            return $this->responseFormatter($err->getCode(),$err->getMessage(),false,null);
        }
    }
}
