<?php

namespace AppBundle\Core\ImportRule;

use AppBundle\Core\Product\Product;

/**
 * Interface FilterInterface is the interface implemented by all import rule classes.
 * @package AppBundle\Core\ImportRule
 */
interface FilterInterface
{
    /**
     * Checks the product for compliance with the import rules.
     *
     * @param Product $product
     *
     * @return bool
     */
    public function isProductAllowed(Product $product);
}
