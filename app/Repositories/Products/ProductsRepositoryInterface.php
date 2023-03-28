<?php

namespace App\Repositories\Products;

interface ProductsRepositoryInterface{
    public function addProduct();
    public function getProduct();
    public function getProductById();
    public function updateProduct();
    public function deleteProduct();
}
