<?php

namespace TheNileTechTest\Model\Rule\Condition;

use TheNileTechTest\Model\Order;

class BuyProductWithOrMoreQty implements ConditionInterface
{
    private $productSku;
    private $quantity;

    public function __construct($productSku, $quantity)
    {
        $this->productSku = $productSku;
        $this->quantity = $quantity;
    }

    public function isEligible(Order $order)
    {
        $orderItem = $order->getOrderItemBySku($this->productSku);
        return !empty($orderItem) && $orderItem->getQuantity() >= $this->quantity;
    }
}
