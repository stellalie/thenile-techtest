<?php

namespace TheNileTechTest\Model\Rule\Action;

use TheNileTechTest\Model\Order;
use TheNileTechTest\Model\OrderItem;

class ApplyBuyXGetY implements ActionInterface
{
    private $buyProductSku;
    private $buyQuantity;
    private $getProductSku;
    private $getQuantity;

    public function __construct($buyProductSku, $buyQuantity, $getProductSku, $getQuantity)
    {
        $this->buyProductSku = $buyProductSku;
        $this->buyQuantity = $buyQuantity;
        $this->getQuantity = $getQuantity;
        $this->getProductSku = $getProductSku;
    }

    public function calculate(Order $order)
    {
        $orderItem = $order->getOrderItemBySku($this->buyProductSku);
        if ($this->buyProductSku === $this->getProductSku) {
            return $this->calculateForSameProduct($orderItem);
        }

        $freeItem = $order->getOrderItemBySku($this->getProductSku);
        if (!empty($freeItem)) {
            return $this->calculateForDifferentProduct($orderItem, $freeItem);
        }

        return 0;
    }

    private function calculateForSameProduct(OrderItem $orderItem)
    {
        $basePrice = $orderItem->getProduct()->getPrice();
        $quantity = $orderItem->getQuantity();

        $buyAndDiscountQty = $this->buyQuantity + $this->getQuantity;
        $fullRuleQtyPeriod = floor($quantity / $buyAndDiscountQty);
        $freeQty = $quantity - $fullRuleQtyPeriod * $buyAndDiscountQty;

        $discountQty = $fullRuleQtyPeriod * $this->getQuantity;
        if ($freeQty > $this->buyQuantity) {
            $discountQty += $freeQty - $this->getQuantity;
        }

        return $discountQty * $basePrice;
    }

    private function calculateForDifferentProduct(OrderItem $orderItem, OrderItem $freeItem)
    {
        $basePrice = $freeItem->getProduct()->getPrice();
        $quantity = $orderItem->getQuantity();

        $discountQty = floor($quantity / $this->buyQuantity) * $this->getQuantity;
        $discountQty = min($freeItem->getQuantity(), $discountQty);

        return $discountQty * $basePrice;
    }
}
