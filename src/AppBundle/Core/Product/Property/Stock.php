<?php

namespace AppBundle\Core\Product\Property;

/**
 * Class Stock
 * @package AppBundle\Core\Product\Property
 */
class Stock extends AbstractProperty
{
    const VALID_VALUE_PATTERN = '/^\d+$/';

    /**
     * {@inheritDoc}
     */
    public function initValue()
    {
        if (preg_match(self::VALID_VALUE_PATTERN, $this->data) === 1) {
            $this->value = (int) $this->data;
        } else {
            $this->value = null;
        }

        return;
    }

    /**
     * {@inheritDoc}
     */
    public function isValid()
    {
        return (null !== $this->value);
    }
}
