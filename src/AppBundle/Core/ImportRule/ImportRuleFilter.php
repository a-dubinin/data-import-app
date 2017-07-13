<?php

namespace AppBundle\Core\ImportRule;

use AppBundle\Core\ImportRule\Rule;
use AppBundle\Core\Product\Product;

/**
 * Class ImportRuleFilter checks the product for compliance with all import rules.
 * @package AppBundle\Core\ImportRule
 */
class ImportRuleFilter implements FilterInterface
{
    /**
     * @var $rules FilterInterface[]
     */
    private $rules = [];

    /**
     * ImportRuleFilter constructor.
     */
    public function __construct()
    {
        $this->rules[] = new Rule\HighCostRule();
        $this->rules[] = new Rule\LowCostAndLowStockRule();
    }

    /**
     * {@inheritDoc}
     */
    public function isProductAllowed(Product $product)
    {
        foreach ($this->rules as $rule) {
            if (false === $rule->isProductAllowed($product)) {
                return false;
            }
        }

        return true;
    }
}
