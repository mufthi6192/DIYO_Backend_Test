<?php

namespace App\ServiceLayer\MerchantKey;

use Illuminate\Http\Request;

interface MerchantKeyServiceInterface{
    public function addKey(Request $request);
}
