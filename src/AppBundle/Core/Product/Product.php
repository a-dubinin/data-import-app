<?php

namespace AppBundle\Core\Product;

use AppBundle\Core\Product\Property;
use AppBundle\Core\Helper\CSVFormatMap;
use AppBundle\Core\ImportRule;

/**
 * Class Product helps to encapsulate product data.
 * @package AppBundle\Core\Product
 */
class Product implements ValidationInterface
{
    /**
     * @var $code Property\Code
     */
    private $code;

    /**
     * @var $name Property\Name
     */
    private $name;

    /**
     * @var $description Property\Description
     */
    private $description;

    /**
     * @var $description Property\Stock
     */
    private $stock;

    /**
     * @var $cost Property\Cost
     */
    private $cost;

    /**
     * @var $discontinued Property\Discontinued
     */
    private $discontinued;

    /**
     * Product constructor.
     *
     * @param Property\Code         $code
     * @param Property\Name         $name
     * @param Property\Description  $description
     * @param Property\Stock        $stock
     * @param Property\Cost         $cost
     * @param Property\Discontinued $discontinued
     */
    private function __construct(
        Property\Code         $code,
        Property\Name         $name,
        Property\Description  $description,
        Property\Stock        $stock,
        Property\Cost         $cost,
        Property\Discontinued $discontinued
    ) {
        $this->code         = $code;
        $this->name         = $name;
        $this->description  = $description;
        $this->stock        = $stock;
        $this->cost         = $cost;
        $this->discontinued = $discontinued;
    }

    /**
     * @return Property\Code
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return Property\Name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Property\Description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return Property\Stock
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @return Property\Cost
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @return Property\Discontinued
     */
    public function getDiscontinued()
    {
        return $this->discontinued;
    }

    /**
     * Builds Product object by data from the row of .csv-file.
     *
     * @param array $rawProperties
     *
     * @return Product
     */
    public static function build(array $rawProperties)
    {
        return new self(
            new Property\Code($rawProperties[CSVFormatMap::COLUMN_PRODUCT_CODE]),
            new Property\Name($rawProperties[CSVFormatMap::COLUMN_PRODUCT_NAME]),
            new Property\Description($rawProperties[CSVFormatMap::COLUMN_PRODUCT_DESC]),
            new Property\Stock($rawProperties[CSVFormatMap::COLUMN_PRODUCT_STOCK]),
            new Property\Cost($rawProperties[CSVFormatMap::COLUMN_PRODUCT_COST]),
            new Property\Discontinued($rawProperties[CSVFormatMap::COLUMN_PRODUCT_DISCONTINUED])
        );
    }

    /**
     * {@inheritDoc}
     */
    public function isValid()
    {
        /**
         * @var $property ValidationInterface
         */
        foreach ($this as $property) {
            if (false === $property->isValid()) {
                return false;
            }
        }

        return true;
    }
}
