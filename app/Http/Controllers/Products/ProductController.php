<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\ServiceLayer\Inventories\InventoriesServiceInterface;
use App\ServiceLayer\Products\ProductsServiceInterface;
use App\ServiceLayer\ProductVariant\ProductVariantServiceInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    private ProductVariantServiceInterface $productVariantService;
    private ProductsServiceInterface $productsService;

    public function __construct(
        ProductVariantServiceInterface $productVariantService,
        ProductsServiceInterface $productsService,
    ){
        $this->productVariantService = $productVariantService;
        $this->productsService = $productsService;
    }
    public function addVariant(Request $request): \Illuminate\Http\JsonResponse
    {
        $response = $this->productVariantService->addVariant($request);
        return response()->json($response,$response['code']);
    }

    public function addProduct(Request $request): \Illuminate\Http\JsonResponse
    {
        $response = $this->productsService->addProduct($request);
        return response()->json($response,$response['code']);
    }

    public function getProduct(Request $request): \Illuminate\Http\JsonResponse
    {
        $response = $this->productsService->getProduct($request);
        return response()->json($response,200);
    }
}
