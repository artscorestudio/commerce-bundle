<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ASF\CommerceBundle\Utils\Manager;

/**
 * Commerce Bundle Manager.
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 */
interface CommerceManagerInterface
{
    /**
     * Create a Tax Instance.
     *
     * @return \ASF\CommerceBundle\Model\Tax\TaxInterface
     */
    public function createTaxInstance();

    /**
     * Create a Discount Instance.
     *
     * @return \ASF\CommerceBundle\Model\Discount\DiscountInterface
     */
    public function createDiscountInstance();

    /**
     * Create a Cart Instance.
     *
     * @return \ASF\CommerceBundle\Model\Cart\CartInterface
     */
    public function createCartInstance();
    
    /**
     * Create a Catalog Instance.
     *
     * @return \ASF\CommerceBundle\Model\Catalog\CatalogInterface
     */
    public function createCatalogInstance();
}
