<?php

namespace AppBundle\Tests\Core\ImportRule\Rule;

use AppBundle\Core\ImportRule\Rule\HighCostRule;

/**
 * Class HighCostRuleTest
 * @package AppBundle\Tests\Core\ImportRule\Rule
 */
class HighCostRuleTest extends AbstractCostRuleTest
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->costRule = new HighCostRule();
    }
}
