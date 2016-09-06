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
use ASF\CommerceBundle\Model\Discount\DiscountInterface;

/**
 * Cart Model
 * 
 * @author Nicolas Claverie <nicolas.claverie@cd31.fr>
 * 
 * @ORM\Entity
 * @ORM\Table(name="asf_commerce_cart")
 * @ORM\HasLifecycleCallbacks
 */
abstract class CartModel implements CartInterface
{
    /**
     * All cart's states are hardcoded in constantes.
     * For historical features reasons, products are not completelly removed form the DB.
     */
    const STATE_WAITING = 'waiting';
    const STATE_CLOSED = 'closed';
    const STATE_VALIDATED = 'validated';
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
     *     CartModel::STATE_WAITING = "waiting",
     *     CartModel::STATE_CLOSED = "closed",
     *     CartModel::STATE_VALIDATED = "validated",
     *     CartModel::STATE_DELETED = "deleted"
     * }, defaultOperator="eq", operatorsVisible=false)
     *
     * @var string
     */
    protected $state;
    
    /**
     * @ORM\ManyToMany(targetEntity="Discount")
     * @ORM\JoinTable(name="asf_commerce_cart_discount",
     *     joinColumns={@ORM\JoinColumn(name="cart_id", referencedColumnName="id", nullable=true)},
     *     inverseJoinColumns={@ORM\JoinColumn(name="discount_id", referencedColumnName="id")},
     * )
     * 
     * @var ArrayCollection
     */
    protected $discounts;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     * @GRID\Column(title="asf.commerce.cart.reference", defaultOperator="like", operatorsVisible=false)
     *
     * @var string
     */
    protected $reference;
    
    /**
     * @ORM\Column(type="float", nullable=true)
     * @GRID\Column(title="asf.commerce.label.total_excl_vat", defaultOperator="like", operatorsVisible=false)
     *
     * @var number
     */
    protected $totalExclVAT;
    
    /**
     * @ORM\Column(type="float")
     * @GRID\Column(title="asf.commerce.label.total_incl_vat", defaultOperator="like", operatorsVisible=false)
     * @Assert\NotBlank()
     *
     * @var number
     */
    protected $totalInclVAT;
    
    /**
     * @ORM\Column(type="datetime", nullable=false)
     * @GRID\Column(visible=false)
     *
     * @var \DateTime
     */
    protected $purchasedAt;
    
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
        $this->state = self::STATE_WAITING;
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->purchasedAt = new \DateTime();
        $this->discounts = new ArrayCollection();
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
     * @see \ASF\CommerceBundle\Model\Cart\CartInterface::getDiscounts()
     */
    public function getDiscounts()
    {
        return $this->discounts;
    }
    
    /**
     * (non-PHPdoc).
     *
     * @see \ASF\CommerceBundle\Model\Cart\CartInterface::addCategories()
     */
    public function addDiscount(DiscountInterface $discount)
    {
        $this->discounts->add($discount);
    
        return $this;
    }
    
    /**
     * (non-PHPdoc).
     *
     * @see \ASF\CommerceBundle\Model\Cart\CartInterface::removeDiscount()
     */
    public function removeDiscount(DiscountInterface $discount)
    {
        $this->discounts->removeElement($discount);
    
        return $this;
    }
    
    /**
     * (non-PHPdoc)
     * @see \ASF\CommerceBundle\Model\Cart\CartInterface::getReference()
     */
    public function getReference()
    {
    	return $this->reference;
    }
    
    /**
     * (non-PHPdoc)
     * @see \ASF\CommerceBundle\Model\Cart\CartInterface::setReference()
     */
    public function setReference($reference)
    {
    	$this->reference = $reference;
    	return $this;
    }
    
    /**
     * (non-PHPdoc)
     * @see \ASF\CommerceBundle\Model\Cart\CartInterface::getTotalExclVAT()
     */
    public function getTotalExclVAT()
    {
    	return $this->totalExclVAT;
    }
    
    /**
     * (non-PHPdoc)
     * @see \ASF\CommerceBundle\Model\Cart\CartInterface::setTotalExclVAT()
     */
    public function setTotalExclVAT($totalExclVAT)
    {
    	$this->totalExclVAT = $totalExclVAT;
    	return $this;
    }
    
    /**
     * (non-PHPdoc)
     * @see \ASF\CommerceBundle\Model\Cart\CartInterface::getTotalInclVAT()
     */
    public function getTotalInclVAT()
    {
    	return $this->totalInclVAT;
    }
    
    /**
     * (non-PHPdoc)
     * @see \ASF\CommerceBundle\Model\Cart\CartInterface::setTotalInclVAT()
     */
    public function setTotalInclVAT($totalInclVAT)
    {
    	$this->totalInclVAT = $totalInclVAT;
    	return $this;
    }
    
    /**
     * (non-PHPdoc)
     * @see \ASF\CommerceBundle\Model\Cart\CartInterface::getPurchaseAt()
     */
    public function getPurchasedAt()
    {
    	return $this->purchasedAt;
    }
    
    /**
     * (non-PHPdoc)
     * @see \ASF\CommerceBundle\Model\Cart\CartInterface::setPurchaseAt()
     */
    public function setPurchasedAt($purchasedAt)
    {
    	$this->purchasedAt = $purchasedAt;
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
            self::STATE_VALIDATED,
            self::STATE_DELETED,
        );
    }
    
    /**
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->type = self::TYPE_PRODUCT;
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