<?php

namespace App\Repositories\ProductVariant;

interface ProductVariantRepositoryInterface{
    public function addVariant(string $name, int $price, int $productId);
    public function getVariantById(int $productId);
}
