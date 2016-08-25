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
     * @return float
     */
    public function getUnitPriceExclVAT();
    
    /**
     * @param float $unitPrice
     * 
     * @return \ASF\CommerceBundle\Model\Product\SellableInterface
     */
    public function setUnitPriceExclVAT($unitPrice);
    
    /**
     * @return number
     */
    public function getQuantity();
    
    public function setQuantity($quantity);
}