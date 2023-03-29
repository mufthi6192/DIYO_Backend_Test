<?php

namespace App\ServiceLayer\Sales;

use Illuminate\Http\Request;

interface SalesServiceInterface{
    public function getSaleById(Request $request,$id);
    public function insertSale(Request $request);
}
