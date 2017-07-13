<?php

namespace AppBundle\Core\Product\Property;

/**
 * Class Cost
 * @package AppBundle\Core\Product\Property
 */
class Cost extends AbstractProperty
{
    const VALID_VALUE_PATTERN = '/^\d{1,8}(\.\d{1,2})?$/';

    /**
     * {@inheritDoc}
     */
    public function initValue()
    {
        if (preg_match(self::VALID_VALUE_PATTERN, $this->data) === 1) {
            $this->value = (float) $this->data;
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
