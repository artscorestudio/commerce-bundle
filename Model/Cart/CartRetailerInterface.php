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

/**
 * Cart Retailer Interface
 * 
 * @author Nicolas Claverie <nicolas.claverie@cd31.fr>
 */
interface CartRetailerInterface
{
    /**
     * @return mixed
     */
    public function getRetailer();
    
    /**
     * @param mixed $retailer
     *
     * @return \ASF\CommerceBundle\Model\Cart\CartInterface
     */
    public function setRetailer($retailer);
}