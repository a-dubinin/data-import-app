<?php

namespace AppBundle\Core\Product;

/**
 * Interface ValidationInterface is the interface implemented by all entities
 * which need to be checked for validity.
 * @package AppBundle\Core\Product
 */
interface ValidationInterface
{
    /**
     * Checks an entity for validity.
     *
     * @return bool
     */
    public function isValid();
}
