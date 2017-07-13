<?php

namespace AppBundle\Core\Product\Property;

use AppBundle\Core\Product\ValidationInterface;

/**
 * Class AbstractProperty
 * @package AppBundle\Core\Product\Property
 */
abstract class AbstractProperty implements ValidationInterface
{
    /**
     * @var $data string
     */
    protected $data;

    /**
     * @var $value mixed
     */
    protected $value;

    /**
     * AbstractProperty constructor.
     *
     * @param string $data
     */
    public function __construct($data)
    {
        $this->data = trim($data);
        $this->initValue();
    }

    /**
     * @return void
     */
    abstract protected function initValue();

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}
