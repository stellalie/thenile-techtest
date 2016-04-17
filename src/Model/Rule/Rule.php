<?php

namespace TheNileTechTest\Model\Rule;

use TheNileTechTest\Model\Rule\Condition\ConditionInterface;
use TheNileTechTest\Model\Rule\Action\ActionInterface;

class Rule
{
    private $condition;
    private $action;

    public function __construct(ConditionInterface $condition, ActionInterface $action)
    {
        $this->condition = $condition;
        $this->action = $action;
    }

    public function getCondition()
    {
        return $this->condition;
    }

    public function getAction()
    {
        return $this->action;
    }
}
