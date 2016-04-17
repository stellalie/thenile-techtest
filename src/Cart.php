<?php

namespace TheNileTechTest;

use TheNileTechTest\Model\Order;
use TheNileTechTest\Model\OrderItem;
use TheNileTechTest\Repository\ProductRepository;
use TheNileTechTest\Repository\RuleRepository;

class Cart
{
    private $productRepository;
    private $ruleRepository;
    private $order;

    public function __construct(ProductRepository $productRepository, RuleRepository $ruleRepository = null)
    {
        $this->productRepository = $productRepository;
        $this->ruleRepository = $ruleRepository;
        $this->order = new Order();
    }

    public function addProduct($productSku, $quantity = 1)
    {
        $product = $this->productRepository->getProductById($productSku);
        $this->order->addProduct($product, $quantity);
    }

    public function total()
    {
        $rules = $this->ruleRepository->getRules();
        return $this->order->calculateTotal($rules);
    }
}
