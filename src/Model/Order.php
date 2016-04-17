<?php

namespace TheNileTechTest\Model;

use TheNileTechTest\Model\Rule\Rule;

class Order
{
    /**
     * @var OrderItem[]
     */
    private $orders;

    public function addProduct(Product $product, $quantity = 1)
    {
        $productSku = $product->getSku();
        if (isset($this->orders[$productSku])) {
            $productQuantity = $this->orders[$productSku]->getQuantity();
            $this->orders[$productSku]->setQuantity($productQuantity + $quantity);
        } else {
            $this->orders[$productSku] = new OrderItem($product, $quantity);
        }
    }

    public function getOrderItemBySku($productSku)
    {
        if (isset($this->orders[$productSku])) {
            return $this->orders[$productSku];
        } else {
            return null;
        }
    }

    public function calculateTotal(array $rules)
    {
        // Apply discount rules
        /** @var Rule $rule */
        $discount = 0;
        foreach ($rules as $rule) {
            $condition = $rule->getCondition();
            $action = $rule->getAction();
            $clonedOrder = clone unserialize(serialize($this));
            if ($condition->isEligible($clonedOrder)) {
                $discount += $action->calculate($clonedOrder);
            }
        }

        // Calculate final price
        $total = 0;
        foreach ($this->orders as $order) {
            $total += $order->getQuantity() * $order->getProduct()->getPrice();
        }
        return $total - $discount;
    }
}
