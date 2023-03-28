<?php

namespace App\ServiceLayer\Products;

interface ProductsServiceInterface{
    public function addProduct();
    public function getProduct();
    public function getProductById();
    public function updateProduct();
    public function deleteProduct();
}
