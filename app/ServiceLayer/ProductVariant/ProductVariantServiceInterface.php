<?php

namespace App\ServiceLayer\ProductVariant;

use Illuminate\Http\Request;

interface ProductVariantServiceInterface{
    public function addVariant(Request $request);
}
