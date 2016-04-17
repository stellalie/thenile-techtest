<?php

namespace TheNileTechTest\Repository;

class ProductRepository
{
    private $products;

    public function __construct(array $products)
    {
        $this->products = $products;
    }

    public function getProductById($productId)
    {
        if (isset($this->products[$productId])) {
            return $this->products[$productId];
        }
        throw new \Exception('Product not found');
    }
}
