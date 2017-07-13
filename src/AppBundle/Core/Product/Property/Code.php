<?php

namespace AppBundle\Core\Product\Property;

/**
 * Class Code
 * @package AppBundle\Core\Product\Property
 */
class Code extends AbstractProperty
{
    // The constant is an example how to check formatted for use with the DB.
    const MAX_VALUE_LENGTH = 10;

    /**
     * {@inheritDoc}
     */
    public function initValue()
    {
        $this->value = $this->data;

        return;
    }

    /**
     * {@inheritDoc}
     */
    public function isValid()
    {
        return !empty($this->value) && (strlen($this->value) <= self::MAX_VALUE_LENGTH);
    }
}
