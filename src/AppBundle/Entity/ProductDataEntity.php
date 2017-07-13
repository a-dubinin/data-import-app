<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductDataEntity
 *
 * @ORM\Table(name="tblProductData", uniqueConstraints={
 *     @ORM\UniqueConstraint(name="strProductCode", columns={"strProductCode"})
 * })
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductDataRepository")
 */
class ProductDataEntity
{
    /**
     * @var int
     *
     * @ORM\Column(name="intProductDataId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $productDataId;

    /**
     * @var string
     *
     * @ORM\Column(name="strProductName", type="string", length=50)
     */
    private $productName;

    /**
     * @var string
     *
     * @ORM\Column(name="strProductDesc", type="string", length=255)
     */
    private $productDesc;

    /**
     * @var string
     *
     * @ORM\Column(name="strProductCode", type="string", length=10, unique=true)
     */
    private $productCode;

    /**
     * @var int
     *
     * @ORM\Column(name="stock", type="integer")
     */
    private $stock;

    /**
     * @var string
     *
     * @ORM\Column(name="cost", type="decimal", precision=8, scale=2)
     */
    private $cost;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dtmAdded", type="datetime", nullable=true)
     */
    private $added;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dtmDiscontinued", type="datetime", nullable=true)
     */
    private $discontinued;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="stmTimestamp", type="datetime")
     */
    private $timestamp;

    /**
     * Get productDataId
     *
     * @return integer
     */
    public function getProductDataId()
    {
        return $this->productDataId;
    }

    /**
     * Set productName
     *
     * @param string $productName
     * @return ProductDataEntity
     */
    public function setProductName($productName)
    {
        $this->productName = $productName;

        return $this;
    }

    /**
     * Get productName
     *
     * @return string
     */
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * Set productDesc
     *
     * @param string $productDesc
     * @return ProductDataEntity
     */
    public function setProductDesc($productDesc)
    {
        $this->productDesc = $productDesc;

        return $this;
    }

    /**
     * Get productDesc
     *
     * @return string
     */
    public function getProductDesc()
    {
        return $this->productDesc;
    }

    /**
     * Set productCode
     *
     * @param string $productCode
     * @return ProductDataEntity
     */
    public function setProductCode($productCode)
    {
        $this->productCode = $productCode;

        return $this;
    }

    /**
     * Get productCode
     *
     * @return string
     */
    public function getProductCode()
    {
        return $this->productCode;
    }

    /**
     * Set stock
     *
     * @param integer $stock
     * @return ProductDataEntity
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get stock
     *
     * @return integer
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set cost
     *
     * @param string $cost
     * @return ProductDataEntity
     */
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Get cost
     *
     * @return string
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Set added
     *
     * @param \DateTime $added
     * @return ProductDataEntity
     */
    public function setAdded($added)
    {
        $this->added = $added;

        return $this;
    }

    /**
     * Get added
     *
     * @return \DateTime
     */
    public function getAdded()
    {
        return $this->added;
    }

    /**
     * Set discontinued
     *
     * @param \DateTime $discontinued
     * @return ProductDataEntity
     */
    public function setDiscontinued($discontinued)
    {
        $this->discontinued = $discontinued;

        return $this;
    }

    /**
     * Get discontinued
     *
     * @return \DateTime
     */
    public function getDiscontinued()
    {
        return $this->discontinued;
    }

    /**
     * Set timestamp
     *
     * @param \DateTime $timestamp
     * @return ProductDataEntity
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Get timestamp
     *
     * @return \DateTime
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }
}
