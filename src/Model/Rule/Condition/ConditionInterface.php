<?php

namespace TheNileTechTest\Model\Rule\Condition;

use TheNileTechTest\Model\Order;

interface ConditionInterface
{
    public function isEligible(Order $order);
}
