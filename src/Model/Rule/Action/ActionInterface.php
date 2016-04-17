<?php

namespace TheNileTechTest\Model\Rule\Action;

use TheNileTechTest\Model\Order;

interface ActionInterface
{
    public function calculate(Order $order);
}
