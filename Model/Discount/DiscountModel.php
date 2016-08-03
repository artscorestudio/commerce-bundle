<?php
/**
 * This file is part of Artscore Studio Framework Package
 *
 * (c) 2012-2015 Artscore Studio <info@artscore-studio.fr>
 *
 * This source file is subject to the MIT Licence that is bundled
 * with this source code in the file LICENSE.
 */
namespace ASF\CommerceBundle\Model\Discount;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use APY\DataGridBundle\Grid\Mapping as GRID;

/**
 * Discount Model
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 * @ORM\Entity
 * @ORM\Table(name="asf_commerce_discount")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"DiscountCart"="DiscountCart", "DiscountProduct"="DiscountProduct"})
 * @ORM\HasLifecycleCallbacks
 */
abstract class DiscountModel implements DiscountInterface
{
	/**
      * All discount's states are hardcoded in constantes.
      * For historical features reasons, discounts are not completelly removed form the DB.
      */
    const STATE_DRAFT = 'draft';
    const STATE_PUBLISHED = 'published';
    const STATE_DELETED = 'deleted';
	
	/**
	 * Available types
	 */
	const TYPE_DISCOUNT_PRODUCT = 'DiscountProduct';
	const TYPE_DISCOUNT_CART = 'DiscountCart';
	
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
     *     DiscountModel::STATE_DRAFT = "draft",
     *     DiscountModel::STATE_PUBLISHED = "published",
     *     DiscountModel::STATE_DELETED = "deleted"
     * }, defaultOperator="eq", operatorsVisible=false)
     *
     * @var string
     */
    protected $state;
	
	/**
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank()
     * @GRID\Column(title="asf.commerce.discount.code", defaultOperator="like", operatorsVisible=false)
     * 
     * @var string
     */
	protected $code;
	
	/**
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank()
     * @GRID\Column(title="asf.commerce.discount.name", defaultOperator="like", operatorsVisible=false)
     * 
     * @var string
     */
	protected $name;
	
	/**
     * @ORM\Column(type="float", nullable=false)
     * @Assert\NotBlank()
     * @GRID\Column(title="asf.commerce.discount.value", defaultOperator="like", operatorsVisible=false)
     * 
     * @var string
     */
	protected $value;
	
	/**
     * @ORM\Column(type="boolean")
     * @GRID\Column(title="asf.commerce.discount.is_pourcent", defaultOperator="like", operatorsVisible=false)
     * 
     * @var string
     */
	protected $isPourcent;
	
	/**
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank()
     * @Assert\Choice(callback = "getTypes")
     * @GRID\Column(title="asf.product.type", filter="select",  selectFrom="values", values={
     *     DiscountModel::TYPE_DISCOUNT_CART = "DiscountCart",
     *     DiscountModel::TYPE_DISCOUNT_PRODUCT = "DiscountProduct"
     * }, defaultOperator="eq", operatorsVisible=false)
     *
     * @var string
     */
	protected $type;
	
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
	
	/**
	 * @var string
	 */
	protected $disc;
	
	public function __construct()
	{
	    $this->state = self::STATE_DRAFT;
		$this->isPourcent = false;
		$this->createdAt = new \DateTime();
		$this->updatedAt = new \DateTime();
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\CommerceBundle\Model\Discount\DiscountInterface::getId()
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\CommerceBundle\Model\Discount\DiscountInterface::getCode()
	 */
	public function getCode()
	{
		return $this->code;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\CommerceBundle\Model\Discount\DiscountInterface::setCode()
	 */
	public function setCode($code)
	{
		$this->code = $code;
		return $this;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\CommerceBundle\Model\Discount\DiscountInterface::getName()
	 */
	public function getName()
	{
		return $this->name;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\CommerceBundle\Model\Discount\DiscountInterface::setName()
	 */
	public function setName($name)
	{
		$this->name = $name;
		return $this;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\CommerceBundle\Model\Discount\DiscountInterface::getValue()
	 */
	public function getValue()
	{
		return $this->value;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\CommerceBundle\Model\Discount\DiscountInterface::setValue()
	 */
	public function setValue($value)
	{
		$this->value = $value;
		return $this;
	}

	/**
	 * (non-PHPdoc)
	 * @see \ASF\CommerceBundle\Model\Discount\DiscountInterface::getIsPourcent()
	 */
	public function getIsPourcent()
	{
		return $this->isPourcent;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\CommerceBundle\Model\Discount\DiscountInterface::setIsPourcent()
	 */
	public function setIsPourcent($is_pourcent)
	{
		$this->isPourcent = $is_pourcent;
		return $this;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\CommerceBundle\Model\Discount\DiscountInterface::getState()
	 */
	public function getState()
	{
		return $this->state;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\CommerceBundle\Model\Discount\DiscountInterface::setState()
	 */
	public function setState($state)
	{
		$this->state = $state;
		return $this;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\CommerceBundle\Model\Discount\DiscountInterface::getType()
	 */
	public function getType()
	{
		return $this->type;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\CommerceBundle\Model\Discount\DiscountInterface::setType()
	 */
	public function setType($type)
	{
		$this->type = $type;
		return $this;
	}
	
	/**
	 * (non-PHPdoc).
	 *
	 * @see \ASF\CommerceBundle\Model\Discount\DiscountInterface::getCreatedAt()
	 */
	public function getCreatedAt()
	{
	    return $this->createdAt;
	}
	
	/**
	 * (non-PHPdoc).
	 *
	 * @see \ASF\CommerceBundle\Model\Discount\DiscountInterface::setCreatedAt()
	 */
	public function setCreatedAt(\DateTime $created_at)
	{
	    $this->createdAt = $created_at;
	
	    return $this;
	}
	
	/**
	 * (non-PHPdoc).
	 *
	 * @see \ASF\CommerceBundle\Model\Discount\DiscountInterface::getUpdatedAt()
	 */
	public function getUpdatedAt()
	{
	    return $this->updatedAt;
	}
	
	/**
	 * (non-PHPdoc).
	 *
	 * @see \ASF\CommerceBundle\Model\Discount\DiscountInterface::setUpdatedAt()
	 */
	public function setUpdatedAt(\DateTime $updated_at)
	{
	    $this->updatedAt = $updated_at;
	
	    return $this;
	}
	
	/**
	 * (non-PHPdoc).
	 *
	 * @see \ASF\CommerceBundle\Model\Discount\DiscountInterface::getDeletedAt()
	 */
	public function getDeletedAt()
	{
	    return $this->deletedAt;
	}
	
	/**
	 * (non-PHPdoc).
	 *
	 * @see \ASF\CommerceBundle\Model\Discount\DiscountInterface::setDeletedAt()
	 */
	public function setDeletedAt(\DateTime $deleted_at)
	{
	    $this->deletedAt = $deleted_at;
	
	    return $this;
	}
	
	/**
	 * @return string
	 */
	public function getDiscr()
	{
	    return $this->discr;
	}
	
	/**
	 * @param string $discr
	 *
	 * @return \ASF\CommerceBundle\Model\Discount\DiscountInterface
	 */
	public function setDiscr($discr)
	{
	    $this->discr = $discr;
	
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
	        self::STATE_DRAFT,
	        self::STATE_PUBLISHED,
	        self::STATE_DELETED,
	    );
	}
	
	/**
	 * Returns types for validators.
	 *
	 * @return array
	 */
	public static function getTypes()
	{
	    return array(
	        self::TYPE_DISCOUNT_CART,
	        self::TYPE_DISCOUNT_PRODUCT,
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