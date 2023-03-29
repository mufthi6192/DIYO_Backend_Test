<?php

namespace App\Repositories\Products;

interface ProductsRepositoryInterface{
    public function addProduct(string $name, string $description, int $price);
    public function getProduct();
}
