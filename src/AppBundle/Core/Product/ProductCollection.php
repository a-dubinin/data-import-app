<?php

namespace AppBundle\Core\Product;

use AppBundle\Core\Exception\DuplicateProductPerFileException;

/**
 * Class ProductCollection allows Product objects to work as arrays.
 * @package AppBundle\Core\Product
 */
class ProductCollection extends \ArrayObject
{
    /**
     * ProductCollection constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setFlags(\ArrayObject::STD_PROP_LIST);
    }

    /**
     * Adds Product into collection.
     *
     * @param Product $product
     *
     * @throws DuplicateProductPerFileException
     */
    public function add(Product $product)
    {
        $productCode = $product->getCode()->getValue();

        /**
         * @TODO:
         * It is required to get the customer approve what to do if there are
         * several products with the same productCodes per one file.
         * To skip and to report or to rewrite.
         */
        if ($this->offsetExists($productCode)) {
            throw new DuplicateProductPerFileException(DuplicateProductPerFileException::MESSAGE);
        } else {
            parent::offsetSet($productCode, $product);
        }
    }

    /**
     * @return array
     */
    public function getProductCodeList()
    {
        return array_keys($this->getArrayCopy());
    }
}
