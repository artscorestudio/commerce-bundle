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

/**
 * Discount Interface
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
interface DiscountInterface
{
	/**
	 * @return integer
	 */
	public function getId();
	
	/**
	 * @return string
	 */
	public function getCode();
	
	/**
	 * @param string $code
	 * @return \ASF\CommerceBundle\Model\Discount\DiscountInterface
	 */
	public function setCode($code);
	
	/**
	 * @return string
	 */
	public function getName();
	
	/**
	 * @param string $name
	 * @return \ASF\CommerceBundle\Model\Discount\DiscountInterface
	 */
	public function setName($name);
	
	/**
	 * @return float
	 */
	public function getValue();
	
	/**
	 * @param float $value
	 * @return \ASF\CommerceBundle\Model\Discount\DiscountInterface
	 */
	public function setValue($value);
	
	/**
	 * @return boolean
	 */
	public function getIsPourcent();
	
	/**
	 * @param boolean $is_pourcent
	 * @return \ASF\CommerceBundle\Model\Discount\DiscountInterface
	 */
	public function setIsPourcent($is_pourcent);
	
	/**
	 * @return string
	 */
	public function getState();
	
	/**
	 * @param string $state
	 * @return \ASF\CommerceBundle\Model\Discount\DiscountInterface
	 */
	public function setState($state);
	
	/**
	 * @return string
	 */
	public function getType();
	
	/**
	 * @param string $type
	 * @return \ASF\CommerceBundle\Model\Discount\DiscountInterface
	 */
	public function setType($type);
	
	/**
	 * @return string
	 */
	public function getDiscr();
	
	/**
	 * @param string $discr
	 * @return \ASF\CommerceBundle\Model\Discount\DiscountInterface
	 */
	public function setDiscr($discr);
	
	/**
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * @param \DateTime $created_at
     *
     * @return \ASF\CommerceBundle\Model\Discount\DiscountInterface
     */
    public function setCreatedAt(\DateTime $created_at);

    /**
     * @return \DateTime
     */
    public function getUpdatedAt();

    /**
     * @param \DateTime $updated_at
     *
     * @return \ASF\CommerceBundle\Model\Discount\DiscountInterface
     */
    public function setUpdatedAt(\DateTime $updated_at);

    /**
     * @return \DateTime
     */
    public function getDeletedAt();

    /**
     * @param \DateTime $deleted_at
     *
     * @return \ASF\CommerceBundle\Model\Discount\DiscountInterface
     */
    public function setDeletedAt(\DateTime $deleted_at);
}