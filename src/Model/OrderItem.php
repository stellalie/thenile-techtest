<?php

namespace TheNileTechTest\Model;

class OrderItem
{
    private $product;
    private $quantity;

    public function __construct(Product $product, $quantity = 1)
    {
        $this->product = $product;
        $this->quantity = $quantity;
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        return $this->quantity = $quantity;
    }
}
