<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ASF\CommerceBundle\Model\Catalog;

/**
 * Catalog Interface
 * 
 * @author Nicolas Claverie <nicolas.claverie@cd31.fr>
 */
interface CatalogInterface
{
    /**
     * @return string
     */
    public function getState();
    
    /**
     * @param string $state
     *
     * @return \ASF\CommerceBundle\Model\Catalog\CatalogInterface
     */
    public function setState($state);
    
    /**
     * @return \DateTime
     */
    public function getCreatedAt();
    
    /**
     * @param \DateTime $created_at
     *
     * @return \ASF\CommerceBundle\Model\Catalog\CatalogInterface
     */
    public function setCreatedAt(\DateTime $created_at);
    
    /**
     * @return \DateTime
     */
    public function getUpdatedAt();
    
    /**
     * @param \DateTime $updated_at
     *
     * @return \ASF\CommerceBundle\Model\Catalog\CatalogInterface
     */
    public function setUpdatedAt(\DateTime $updated_at);
    
    /**
     * @return \DateTime
     */
    public function getDeletedAt();
    
    /**
     * @param \DateTime $deleted_at
     *
     * @return \ASF\CommerceBundle\Model\Catalog\CatalogInterface
     */
    public function setDeletedAt(\DateTime $deleted_at);
}