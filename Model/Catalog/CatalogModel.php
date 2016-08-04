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

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use APY\DataGridBundle\Grid\Mapping as GRID;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Catalog Model
 * 
 * @author Nicolas Claverie <nicolas.claverie@cd31.fr>
 * 
 * @ORM\Entity
 * @ORM\Table(name="asf_commerce_catalog")
 * @ORM\HasLifecycleCallbacks
 */
abstract class CatalogModel implements CatalogInterface
{
    /**
     * All catalog's states are hardcoded in constantes.
     * For historical features reasons, products are not completelly removed form the DB.
     */
    const STATE_DRAFT = 'draft';
    const STATE_PUBLISHED = 'published';
    const STATE_DELETED = 'deleted';
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @GRID\Column(visible=false)
     * 
     * @var int
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank()
     * @Assert\Choice(callback = "getStates")
     * @GRID\Column(title="asf.commerce.state", filter="select",  selectFrom="values", values={
     *     CatalogModel::STATE_DRAFT = "draft",
     *     CatalogModel::STATE_PUBLISHED = "published",
     *     CatalogModel::STATE_DELETED = "deleted"
     * }, defaultOperator="eq", operatorsVisible=false)
     *
     * @var string
     */
    protected $state;
    
    /**
     * @ORM\Column(type="datetime", nullable=false)
     * @GRID\Column(visible=false)
     *
     * @var \DateTime
     */
    protected $createdAt;
    
    /**
     * @ORM\Column(type="datetime", nullable=false)
     * @GRID\Column(visible=false)
     *
     * @var \DateTime
     */
    protected $updatedAt;
    
    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @GRID\Column(visible=false)
     *
     * @var \DateTime
     */
    protected $deletedAt;
    
    public function __construct()
    {
        $this->state = self::STATE_DRAFT;
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }
    
    /**
     * (non-PHPdoc).
     *
     * @see \ASF\CommerceBundle\Model\Cart\CartInterface::getId()
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * (non-PHPdoc).
     *
     * @see \ASF\CommerceBundle\Model\Cart\CartInterface::getState()
     */
    public function getState()
    {
        return $this->state;
    }
    
    /**
     * (non-PHPdoc).
     *
     * @see \ASF\CommerceBundle\Model\Cart\CartInterface::setState()
     */
    public function setState($state)
    {
        $this->state = $state;
    
        return $this;
    }
        
    /**
     * (non-PHPdoc).
     *
     * @see \ASF\CommerceBundle\Model\Cart\CartInterface::getCreatedAt()
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    
    /**
     * (non-PHPdoc).
     *
     * @see \ASF\CommerceBundle\Model\Cart\CartInterface::setCreatedAt()
     */
    public function setCreatedAt(\DateTime $created_at)
    {
        $this->createdAt = $created_at;
    
        return $this;
    }
    
    /**
     * (non-PHPdoc).
     *
     * @see \ASF\CommerceBundle\Model\Cart\CartInterface::getUpdatedAt()
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
    
    /**
     * (non-PHPdoc).
     *
     * @see \ASF\CommerceBundle\Model\Cart\CartInterface::setUpdatedAt()
     */
    public function setUpdatedAt(\DateTime $updated_at)
    {
        $this->updatedAt = $updated_at;
    
        return $this;
    }
    
    /**
     * (non-PHPdoc).
     *
     * @see \ASF\CommerceBundle\Model\Cart\CartInterface::getDeletedAt()
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }
    
    /**
     * (non-PHPdoc).
     *
     * @see \ASF\CommerceBundle\Model\Cart\CartInterface::setDeletedAt()
     */
    public function setDeletedAt(\DateTime $deleted_at)
    {
        $this->deletedAt = $deleted_at;
    
        return $this;
    }
    
    /**
     * Returns states for validators.
     *
     * @return array
     */
    public static function getStates()
    {
        return array(
            self::STATE_WAITING,
            self::STATE_CLOSED,
            self::STATE_DELETED,
        );
    }
        
    /**
     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        if (self::STATE_DELETED === $this->state) {
            $this->deletedAt = new \DateTime();
        }
        $this->updatedAt = new \DateTime();
    }
}