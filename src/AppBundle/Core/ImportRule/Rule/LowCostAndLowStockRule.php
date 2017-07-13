<?php

namespace AppBundle\Core\ImportRule\Rule;

use AppBundle\Core\ImportRule\FilterInterface;
use AppBundle\Core\Product\Product;
use AppBundle\Core\Helper\CurrencyConverterHelper;

/**
 * Class LowCostAndLowStockRule
 * @package AppBundle\Core\ImportRule\Rule
 */
class LowCostAndLowStockRule implements FilterInterface
{
    const LOW_COST_VALUE  = 5; // in USD
    const LOW_STOCK_VALUE = 10;

    /**
     * @var $convertedCostValue float
     */
    private $convertedCostValue;

    /**
     * LowCostAndLowStockRule constructor.
     */
    public function __construct()
    {
        $this->convertedCostValue = CurrencyConverterHelper::getInstance()->convert(
            CurrencyConverterHelper::USD,
            CurrencyConverterHelper::GBP,
            self::LOW_COST_VALUE
        );
    }

    /**
     * {@inheritDoc}
     */
    public function isProductAllowed(Product $product)
    {
        if ($product->getCost()->getValue() < $this->convertedCostValue
            && $product->getStock()->getValue() < self::LOW_STOCK_VALUE
        ) {
            return false;
        }
        return true;
    }
}
