<?php

namespace AppBundle\Tests\Core\Product;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use AppBundle\Core\Product\Product;
use AppBundle\Core\Product\Property;

/**
 * Class ProductTest
 * @package AppBundle\Tests\Core\Product
 */
class ProductTest extends KernelTestCase
{
    /**
     * @covers \AppBundle\Core\Product\Product::build()
     * @covers \AppBundle\Core\Product\Product::__construct()
     *
     * @dataProvider rawPropertiesDataProvider
     * @dataProvider invalidRawPropertiesDataProvider
     *
     * @param array $rawProperties
     */
    public function testBuild(array $rawProperties)
    {
        $actualProduct = Product::build($rawProperties);

        $actualCode         = self::getObjectAttribute($actualProduct, 'code');
        $actualName         = self::getObjectAttribute($actualProduct, 'name');
        $actualDescription  = self::getObjectAttribute($actualProduct, 'description');
        $actualStock        = self::getObjectAttribute($actualProduct, 'stock');
        $actualCost         = self::getObjectAttribute($actualProduct, 'cost');
        $actualDiscontinued = self::getObjectAttribute($actualProduct, 'discontinued');

        self::assertInstanceOf(Property\Code::class, $actualCode);
        self::assertInstanceOf(Property\Name::class, $actualName);
        self::assertInstanceOf(Property\Description::class, $actualDescription);
        self::assertInstanceOf(Property\Stock::class, $actualStock);
        self::assertInstanceOf(Property\Cost::class, $actualCost);
        self::assertInstanceOf(Property\Discontinued::class, $actualDiscontinued);
    }

    /**
     * @covers \AppBundle\Core\Product\Product::isValid()
     * @covers \AppBundle\Core\Product\Property\Code::isValid()
     * @covers \AppBundle\Core\Product\Property\Name::isValid()
     * @covers \AppBundle\Core\Product\Property\Description::isValid()
     * @covers \AppBundle\Core\Product\Property\Stock::isValid()
     * @covers \AppBundle\Core\Product\Property\Cost::isValid()
     * @covers \AppBundle\Core\Product\Property\Discontinued::isValid()
     *
     * @dataProvider rawPropertiesDataProvider
     *
     * @param array $rawProperties
     */
    public function testIsValid(array $rawProperties)
    {
        $product = Product::build($rawProperties);

        self::assertTrue($product->isValid());
    }

    /**
     * @covers \AppBundle\Core\Product\Product::isValid()
     * @covers \AppBundle\Core\Product\Property\Code::isValid()
     * @covers \AppBundle\Core\Product\Property\Name::isValid()
     * @covers \AppBundle\Core\Product\Property\Description::isValid()
     * @covers \AppBundle\Core\Product\Property\Stock::isValid()
     * @covers \AppBundle\Core\Product\Property\Cost::isValid()
     * @covers \AppBundle\Core\Product\Property\Discontinued::isValid()
     *
     * @dataProvider invalidRawPropertiesDataProvider
     *
     * @param array $rawProperties
     */
    public function testIsInvalid(array $rawProperties)
    {
        $product = Product::build($rawProperties);

        self::assertFalse($product->isValid());
    }

    /**
     * @return array
     */
    public function rawPropertiesDataProvider()
    {
        return [
            [
                ['P0001','TV','31” Tv','10','399.99','']
            ],
            [
                ['P0009','Harddisk','Great for storing data','0','99.99','']
            ],
            [
                ['P0024','PS3','Just don\'t go online','22','24.33','yes']
            ],
        ];
    }

    /**
     * @return array
     */
    public function invalidRawPropertiesDataProvider()
    {
        return [
            [
                ['Product Code','Product Name','Product Description','Stock','Cost in GBP','Discontinued']
            ],
            [
                ['P0007','24” Monitor','Awesome','','35.99','']
            ],
            [
                ['P0007','24” Monitor','','10','35.99','yes']
            ],
            [
                ['P0007','24” Monitor','Awesome','10','','yes']
            ],
            [
                ['P0015','Bluray Player','Excellent picture','32','$4.33','']
            ],
            [
                ['','Bluray Player','Excellent picture','32','4.33','yes']
            ],
            [
                ['P0015','','Excellent picture','32','4.33','']
            ],
            [
                ['12345678911','Bluray Player','Excellent picture','32','4.33','yes']
            ],
        ];
    }
}
