<?php

namespace AppBundle\Core\Product\Property;

/**
 * Class Discontinued
 * @package AppBundle\Core\Product\Property
 */
class Discontinued extends AbstractProperty
{
    const DEFAULT_VALUE_DISCONTINUED = 'yes';

    /**
     * {@inheritDoc}
     */
    public function initValue()
    {
        $normalizeData = strtolower($this->data);
        $this->value   = (self::DEFAULT_VALUE_DISCONTINUED === $normalizeData);

        return;
    }

    /**
     * {@inheritDoc}
     */
    public function isValid()
    {
        return true;
    }
}
