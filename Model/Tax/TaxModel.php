<?php
/**
 * This file is part of Artscore Studio Framework Package
 *
 * (c) 2012-2015 Artscore Studio <info@artscore-studio.fr>
 *
 * This source file is subject to the MIT Licence that is bundled
 * with this source code in the file LICENSE.
 */
namespace ASF\CommerceBundle\Model\Tax;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use APY\DataGridBundle\Grid\Mapping as GRID;

/**
 * Tax Model.
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 * 
 * @ORM\Entity
 * @ORM\Table(name="asf_commerce_tax")
 * @ORM\HasLifecycleCallbacks
 */
abstract class TaxModel implements TaxInterface
{
	 /**
      * All cart's states are hardcoded in constantes.
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
     * @GRID\Column(title="asf.commerce.label.state", filter="select",  selectFrom="values", values={
     *     TaxModel::STATE_DRAFT = "draft",
     *     TaxModel::STATE_PUBLISHED = "published",
     *     TaxModel::STATE_DELETED = "deleted"
     * }, defaultOperator="eq", operatorsVisible=false)
     *
     * @var string
     */
    protected $state;
	
	/**
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank()
     * @GRID\Column(title="asf.commerce.label.tax_name", defaultOperator="like", operatorsVisible=false)
     * 
     * @var string
     */
	protected $name;
	
	/**
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank()
     * @GRID\Column(title="asf.commerce.label.country", defaultOperator="like", operatorsVisible=false)
     * 
     * @var string
     */
	protected $countryCode;
	
	/**
     * @ORM\Column(type="float", nullable=false)
     * @Assert\NotBlank()
     * @GRID\Column(title="asf.commerce.label.tax_rate", defaultOperator="eq", operatorsVisible=false)
     * 
     * @var string
     */
	protected $value;

	/**
	 * @ORM\Column(type="text", nullable=true)
	 * @GRID\Column(title="asf.commerce.label.tax_description", operatorsVisible=false)
	 *
	 * @var string
	 */
	protected $description;
	
	/**
     * @ORM\Column(type="boolean")
     * @GRID\Column(visible=false)
     * 
     * @var string
     */
	protected $isPourcent;
	
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
		$this->isPourcent = true;
		$this->state = self::STATE_DRAFT;
		$this->createdAt = new \DateTime();
		$this->updatedAt = new \DateTime();
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\CommerceBundle\Model\Tax\TaxInterface::getId()
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\CommerceBundle\Model\Tax\TaxInterface::getName()
	 */
	public function getName()
	{
		return $this->name;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\CommerceBundle\Model\Tax\TaxInterface::setName()
	 */
	public function setName($name)
	{
		$this->name = $name;
		return $this;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\CommerceBundle\Model\Tax\TaxInterface::setCountryCode()
	 */
	public function getCountryCode()
	{
		return $this->countryCode;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\CommerceBundle\Model\Tax\TaxInterface::setCountryCode()
	 */
	public function setCountryCode($countryCode)
	{
		$this->countryCode = $countryCode;
		return $this;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\CommerceBundle\Model\Tax\TaxInterface::getValue()
	 */
	public function getValue()
	{
		return $this->value;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\CommerceBundle\Model\Tax\TaxInterface::setValue()
	 */
	public function setValue($value)
	{
		$this->value = $value;
		return $this;
	}

	/**
	 * (non-PHPdoc)
	 * @see \ASF\CommerceBundle\Model\Tax\TaxInterface::getDescription()
	 */
	public function getDescription()
	{
	    return $this->description;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\CommerceBundle\Model\Tax\TaxInterface::setDescription()
	 */
	public function setDescription($description)
	{
	    $this->description = $description;
	    return $this;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\CommerceBundle\Model\Tax\TaxInterface::getState()
	 */
	public function getState()
	{
		return $this->state;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\CommerceBundle\Model\Tax\TaxInterface::setState()
	 */
	public function setState($state)
	{
		$this->state = $state;
		return $this;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\CommerceBundle\Model\Tax\TaxInterface::getIsPourcent()
	 */
	public function getIsPourcent()
	{
		return $this->isPourcent;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\CommerceBundle\Model\Tax\TaxInterface::setIsPourcent()
	 */
	public function setIsPourcent($is_pourcent)
	{
		$this->isPourcent = $is_pourcent;
		return $this;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\CommerceBundle\Model\Tax\TaxInterface::getCreatedAt()
	 */
	public function getCreatedAt()
	{
		return $this->createdAt;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\CommerceBundle\Model\Tax\TaxInterface::setCreatedAt()
	 */
	public function setCreatedAt(\DateTime $date)
	{
		$this->createdAt = $date;
		return $this;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\CommerceBundle\Model\Tax\TaxInterface::getUpdatedAt()
	 */
	public function getUpdatedAt()
	{
		return $this->updatedAt;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\CommerceBundle\Model\Tax\TaxInterface::setUpdatedAt()
	 */
	public function setUpdatedAt(\DateTime $date)
	{
		$this->updatedAt = $date;
		return $this;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\CommerceBundle\Model\Tax\TaxInterface::getDeletedAt()
	 */
	public function getDeletedAt()
	{
		return $this->deletedAt;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\CommerceBundle\Model\Tax\TaxInterface::setDeletedAt()
	 */
	public function setDeletedAt(\DateTime $date)
	{
		$this->deletedAt = $date;
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