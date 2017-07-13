<?php

namespace AppBundle\Core\Product\Property;

/**
 * Class Name
 * @package AppBundle\Core\Product\Property
 */
class Name extends AbstractProperty
{
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
        return !empty($this->value);
    }
}
