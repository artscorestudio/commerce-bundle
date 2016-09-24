<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ASF\CommerceBundle\Model\Product;

use ASF\CommerceBundle\Model\Tax\TaxInterface;
use ASW\CommerceBundle\Entity\DiscountProduct;

/**
 * Interface for defined products can be sold.
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
interface SellableInterface
{
    /**
     * @return mixed
     */
    public function getProduct();
    
    /**
     * @param mixed $product
     * 
     * @return \ASF\CommerceBundle\Model\Product\SellableInterface 
     */
    public function setProduct($product);
    
    /**
     * @return number
     */
    public function getUnitPriceExclVAT();
    
    /**
     * @param number $unitPrice
     * 
     * @return \ASF\CommerceBundle\Model\Product\SellableInterface
     */
    public function setUnitPriceExclVAT($price);
    
    /**
     * @return number
     */
    public function getUnitPriceInclVAT();
    
    /**
     * @param number $price
     * @return \ASF\CommerceBundle\Model\Product\SellableInterface
     */
    public function setUnitPriceInclVAT($price);
    
    /**
     * @return number
     */
    public function getTotalInclVAT();
    
    /**
     * @param number $price
     * @return \ASF\CommerceBundle\Model\Product\SellableInterface
     */
    public function setTotalInclVAT($price);
    
    /**
     * @return number
     */
    public function getTotalExclVAT();
    
    /**
     * @param number $price
     * @return \ASF\CommerceBundle\Model\Product\SellableInterface
     */
    public function setTotalExclVAT($price);
    
    /**
     * @return number
     */
    public function getQuantity();
    
    /**
     * @param number $quantity
     */
    public function setQuantity($quantity);
    
    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getTaxes();
    
    /**
     * @param TaxInterface $tax
     * @return \ASF\CommerceBundle\Model\Product\SellableInterface
     */
    public function addTax(TaxInterface $tax);
    
    /**
     * @param TaxInterface $tax
     * @return \ASF\CommerceBundle\Model\Product\SellableInterface
     */
    public function removeTax(TaxInterface $tax);
}