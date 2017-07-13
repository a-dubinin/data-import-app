<?php

namespace AppBundle\Tests\Core\ImportRule;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use AppBundle\Core\ImportRule\ImportRuleFilter;
use AppBundle\Core\ImportRule\FilterInterface;
use AppBundle\Core\Product\Product;

/**
 * Class ImportRuleFilterTest
 * @package AppBundle\Tests\Core\ImportRule
 */
class ImportRuleFilterTest extends KernelTestCase
{
    /**
     * @var $importRuleFilter ImportRuleFilter
     */
    protected $importRuleFilter;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->importRuleFilter = new ImportRuleFilter();
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        $this->importRuleFilter = null;
    }

    /**
     * @covers \AppBundle\Core\ImportRule\ImportRuleFilter::__construct()
     */
    public function testConstructor()
    {
        $actualRules = self::getObjectAttribute($this->importRuleFilter, 'rules');

        foreach ($actualRules as $actualRule) {
            self::assertInstanceOf(FilterInterface::class, $actualRule);
        }
    }

    /**
     * @covers \AppBundle\Core\ImportRule\ImportRuleFilter::isProductAllowed()
     * @covers \AppBundle\Core\ImportRule\Rule\HighCostRule::isProductAllowed()
     * @covers \AppBundle\Core\ImportRule\Rule\LowCostAndLowStockRule::isProductAllowed()
     *
     * @dataProvider isProductAllowedDataProvider
     *
     * @param array $productData
     */
    public function testIsProductAllowed(array $productData)
    {
        $product = Product::build($productData);

        self::assertTrue($this->importRuleFilter->isProductAllowed($product));
    }

    /**
     * @covers \AppBundle\Core\ImportRule\ImportRuleFilter::isProductAllowed()
     * @covers \AppBundle\Core\ImportRule\Rule\HighCostRule::isProductAllowed()
     * @covers \AppBundle\Core\ImportRule\Rule\LowCostAndLowStockRule::isProductAllowed()
     *
     * @dataProvider isProductForbiddenDataProvider
     *
     * @param array $productData
     */
    public function testIsProductForbidden(array $productData)
    {
        $product = Product::build($productData);

        self::assertFalse($this->importRuleFilter->isProductAllowed($product));
    }

    /**
     * @return array
     */
    public function isProductAllowedDataProvider()
    {
        return [
            [
                ['P0001','TV','32 Tv','10','399.99','']
            ],
            [
                ['P0002','CD Bundle One','Lots of fun','33','2','yes']
            ],
        ];
    }

    /**
     * @return array
     */
    public function isProductForbiddenDataProvider()
    {
        return [
            [
                ['P0028','Bluray Player','Plays bluray\'s','32','1100.04','yes']
            ],
            [
                ['P0010','CD Bundle','Lots of fun','1','2.7','']
            ],
        ];
    }
}
