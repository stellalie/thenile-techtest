<?php

namespace TheNileTechTest\Model\Rule\Action;

use TheNileTechTest\Model\Order;

class UseFixedPrice implements ActionInterface
{
    private $productSku;
    private $price;

    public function __construct($productSku, $price)
    {
        $this->productSku = $productSku;
        $this->price = $price;
    }

    public function calculate(Order $order)
    {
        $orderItem = $order->getOrderItemBySku($this->productSku);
        $quantity = $orderItem->getQuantity();
        $basePrice = $orderItem->getProduct()->getPrice();

        return $quantity * ($basePrice - $this->price);
    }
}
