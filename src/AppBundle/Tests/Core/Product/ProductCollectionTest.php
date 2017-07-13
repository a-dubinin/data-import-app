<?php

namespace AppBundle\Tests\Core\Product;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use AppBundle\Core\Product\ProductCollection;
use AppBundle\Core\Product\Product;

/**
 * Class ProductCollectionTest
 * @package AppBundle\Tests\Core\Product
 */
class ProductCollectionTest extends KernelTestCase
{
    /**
     * @var $productCollection ProductCollection
     */
    protected $productCollection;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->productCollection = new ProductCollection();
        $this->productCollection->add(Product::build(['P0001','TV','31” Tv','10','399.99','']));
        $this->productCollection->add(Product::build(['P0009','Harddisk','Great for storing data','0','99.99','']));
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        $this->productCollection = null;
    }

    /**
     * @expectedException \AppBundle\Core\Exception\DuplicateProductPerFileException
     */
    public function testDuplicateProductPerFileException()
    {
        $this->productCollection->add(Product::build(['P0001','TV','31” Tv','10','399.99','']));
    }

    /**
     * @covers \AppBundle\Core\Product\ProductCollection::getProductCodeList()
     */
    public function testGetProductCodeList()
    {
        self::assertEquals(
            ['P0001', 'P0009'],
            $this->productCollection->getProductCodeList()
        );
    }

    /**
     * @covers \AppBundle\Core\Product\ProductCollection::add()
     */
    public function testAdd()
    {
        $product = Product::build(['P0024','PS3','Just don\'t go online','22','24.33','yes']);
        $this->productCollection->add($product);

        $productCode = $product->getCode()->getValue();

        self::assertTrue($this->productCollection->offsetExists($productCode));
    }
}
