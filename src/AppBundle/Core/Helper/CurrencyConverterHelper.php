<?php

namespace AppBundle\Core\Helper;

use CurrencyConverter\CurrencyConverterInterface;
use CurrencyConverter\CurrencyConverter;

/**
 * Class CurrencyConverterHelper is an abstraction level
 * of the 'Exchange rates/Currency Converter Library'.
 * @package AppBundle\Core\Helper
 */
class CurrencyConverterHelper implements CurrencyConverterInterface
{
    const CURRENCY_SEPARATOR = '/';

    const USD = 'USD';
    const GBP = 'GBP';

    /**
     * @var $instance null|CurrencyConverterHelper
     */
    private static $instance = null;

    /**
     * @var $converter CurrencyConverterInterface
     */
    private $converter;

    /**
     * @var $inMemoryCache array
     */
    private $inMemoryCache = [];

    /**
     * CurrencyConverterHelper constructor.
     */
    private function __construct()
    {
        $this->converter = new CurrencyConverter();
    }

    /**
     * @return CurrencyConverterHelper
     */
    public static function getInstance()
    {
        return self::$instance !== null
            ? self::$instance
            : self::$instance = new self();
    }

    /**
     * {@inheritDoc}
     */
    public function convert($from, $to, $amount = 1)
    {
        if (isset($this->inMemoryCache[$from . self::CURRENCY_SEPARATOR . $to])) {
            return $this->inMemoryCache[$from . self::CURRENCY_SEPARATOR . $to] * $amount;
        } elseif (isset($this->inMemoryCache[$to . self::CURRENCY_SEPARATOR . $from])) {
            return (1 / $this->inMemoryCache[$to . self::CURRENCY_SEPARATOR . $from]) * $amount;
        }

        $rate = $this->converter->getRateProvider()->getRate($from, $to);

        $this->inMemoryCache[$from . self::CURRENCY_SEPARATOR . $to] = $rate;

        return $rate * $amount;
    }
}
