<?php

namespace AppBundle\Core\ImportRule\Rule;

use AppBundle\Core\ImportRule\FilterInterface;
use AppBundle\Core\Product\Product;
use AppBundle\Core\Helper\CurrencyConverterHelper;

/**
 * Class HighCostRule
 * @package AppBundle\Core\ImportRule\Rule
 */
class HighCostRule implements FilterInterface
{
    const HIGH_COST_VALUE = 1000; // in USD

    /**
     * @var $convertedCostValue float
     */
    private $convertedCostValue;

    /**
     * HighCostRule constructor.
     */
    public function __construct()
    {
        $this->convertedCostValue = CurrencyConverterHelper::getInstance()->convert(
            CurrencyConverterHelper::USD,
            CurrencyConverterHelper::GBP,
            self::HIGH_COST_VALUE
        );
    }

    /**
     * {@inheritDoc}
     */
    public function isProductAllowed(Product $product)
    {
        return ($product->getCost()->getValue() <= $this->convertedCostValue);
    }
}
