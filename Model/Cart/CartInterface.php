<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ASF\CommerceBundle\Model\Cart;

use Doctrine\Common\Collections\ArrayCollection;
use ASF\CommerceBundle\Model\Discount\DiscountInterface;

/**
 * Cart Interface
 * 
 * @author Nicolas Claverie <nicolas.claverie@cd31.fr>
 */
interface CartInterface
{
    /**
     * @return string
     */
    public function getState();
    
    /**
     * @param string $state
     *
     * @return \ASF\CommerceBundle\Model\Cart\CartInterface
     */
    public function setState($state);
    
    /**
     * @return ArrayCollection
     */
    public function getDiscounts();
    
    /**
     * @param DiscountInterface $discount
     *
     * @return \ASF\CommerceBundle\Model\Cart\CartInterface
     */
    public function addDiscount(DiscountInterface $discount);
    
    /**
     * @param DiscountInterface $discount
     *
     * @return \ASF\CommerceBundle\Model\Cart\CartInterface
     */
    public function removeDiscount(DiscountInterface $discount);
    
    /**
     * @return string
     */
    public function getReference();
    
    /**
     * @param string $refernce
     *
     * @return \ASF\CommerceBundle\Model\Cart\CartInterface
     */
    public function setReference($reference);
    
    /**
     * @return number
     */
    public function getTotalExclVAT();
    
    /**
     * @param number $totalExclVAT
     * @return \ASF\CommerceBundle\Model\Cart\CartInterface
     */
    public function setTotalExclVAT($totalExclVAT);
    
    /**
     * @return number
     */
    public function getTotalInclVAT();
    
    /**
     * @param number $totalInclVAT
     * @return \ASF\CommerceBundle\Model\Cart\CartInterface
     */
    public function setTotalInclVAT($totalInclVAT);
    
    /**
     * @return \DateTime
     */
    public function getPurchasedAt();
    
    /**
     * @param \DateTime $purchasedAt
     *
     * @return \ASF\CommerceBundle\Model\Cart\CartInterface
     */
    public function setPurchasedAt($purchasedAt);
    
    /**
     * @return \DateTime
     */
    public function getCreatedAt();
    
    /**
     * @param \DateTime $created_at
     *
     * @return \ASF\CommerceBundle\Model\Cart\CartInterface
     */
    public function setCreatedAt(\DateTime $created_at);
    
    /**
     * @return \DateTime
     */
    public function getUpdatedAt();
    
    /**
     * @param \DateTime $updated_at
     *
     * @return \ASF\CommerceBundle\Model\Cart\CartInterface
     */
    public function setUpdatedAt(\DateTime $updated_at);
    
    /**
     * @return \DateTime
     */
    public function getDeletedAt();
    
    /**
     * @param \DateTime $deleted_at
     *
     * @return \ASF\CommerceBundle\Model\Cart\CartInterface
     */
    public function setDeletedAt(\DateTime $deleted_at);
}