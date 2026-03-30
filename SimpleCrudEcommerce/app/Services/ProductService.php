<?php

namespace App\Services;

class ProductService {
    public function getSampleProducts() {
        return [
            ['id' => 1, 'name' => 'Laptop', 'price' => 15000],
            ['id' => 2, 'name' => 'Mouse', 'price' => 500],
        ];
    }
}