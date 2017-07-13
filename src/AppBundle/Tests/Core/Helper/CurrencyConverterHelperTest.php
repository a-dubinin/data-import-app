<?php

namespace AppBundle\Tests\Core\Helper;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use CurrencyConverter\CurrencyConverter;
use CurrencyConverter\Provider\YahooApi;
use AppBundle\Core\Helper\CurrencyConverterHelper;

/**
 * Class CurrencyConverterHelperTest
 * @package AppBundle\Tests\Core\Helper
 */
class CurrencyConverterHelperTest extends KernelTestCase
{
    /**
     * @covers \AppBundle\Core\Helper\CurrencyConverterHelper::getInstance()
     * @covers \AppBundle\Core\Helper\CurrencyConverterHelper::__construct()
     */
    public function testGetInstance()
    {
        $actualCurrencyConverterHelper = CurrencyConverterHelper::getInstance();
        $actualConverter = self::getObjectAttribute($actualCurrencyConverterHelper, 'converter');

        self::assertInstanceOf(CurrencyConverterHelper::class, $actualCurrencyConverterHelper);
        self::assertEquals(new CurrencyConverter(), $actualConverter);
        self::assertClassHasStaticAttribute('instance', CurrencyConverterHelper::class);
        self::assertClassHasAttribute('inMemoryCache', CurrencyConverterHelper::class);
    }

    /**
     * @covers \AppBundle\Core\Helper\CurrencyConverterHelper::convert()
     */
    public function testConvert()
    {
        $rateProviderMock = $this->getMockBuilder(YahooApi::class)
                                 ->disableOriginalConstructor()
                                 ->getMock();
        $rateProviderMock->expects($this->any())
                         ->method('getRate')
                         ->will($this->returnValue(0.777));

        $converterHelper = CurrencyConverterHelper::getInstance();
        $converter = self::getObjectAttribute($converterHelper, 'converter');
        $converter->setRateProvider($rateProviderMock);

        self::assertEquals(0.777, $converterHelper->convert('USD', 'GBP'));
        self::assertEquals(1/0.777, $converterHelper->convert('GBP', 'USD'));
    }
}
