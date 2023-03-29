<?php

namespace App\Repositories\MerchantKey;

interface MerchantKeyRepositoryInterface{
    public function addKey(string $key);
    public function countKey(string $key);
}
