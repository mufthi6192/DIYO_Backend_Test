<?php

namespace App\ServiceLayer\Products;

use Illuminate\Http\Request;

interface ProductsServiceInterface{
    public function addProduct(Request $request);
    public function getProduct(Request $request);
    public function getProductById();
}
