<?php

namespace AppBundle\Core\Exception;

/**
 * Class DuplicateProductPerFileException
 * @package AppBundle\Core\Exception
 */
class DuplicateProductPerFileException extends \Exception
{
    const MESSAGE = 'An one file must contain unique products';
}
