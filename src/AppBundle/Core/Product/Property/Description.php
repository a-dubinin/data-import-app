<?php

namespace AppBundle\Core\Product\Property;

/**
 * Class Description
 * @package AppBundle\Core\Product\Property
 */
class Description extends AbstractProperty
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
