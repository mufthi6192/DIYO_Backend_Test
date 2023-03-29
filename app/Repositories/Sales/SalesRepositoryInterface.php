<?php

namespace App\Repositories\Sales;

interface SalesRepositoryInterface{
    public function getSaleById($id);
    public function insertSale(string $id, int $total_price,string $payment_method,int $productId);
    public function getTotalPrice(int $productId);
}
