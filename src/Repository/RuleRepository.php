<?php

namespace TheNileTechTest\Repository;

use TheNileTechTest\Model\Rule\Rule;

class RuleRepository
{
    /**
     * @var Rule[]
     */
    private $rules;

    public function __construct(array $rules)
    {
        $this->rules = $rules;
    }

    public function getRules()
    {
        return $this->rules;
    }
}
