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

/**
 * Tax Interface
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
interface TaxInterface
{
	/**
	 * @return number
	 */
	public function getId();
	
	/**
	 * @return string
	 */
	public function getName();
	
	/**
	 * @param string $name
	 * @return \ASF\CommerceBundle\Model\Tax\TaxInterface
	 */
	public function setName($name);
	
	/**
	 * @return string
	 */
	public function getCountryCode();
	
	/**
	 * @param string $countryCode
	 * @return \ASF\CommerceBundle\Model\Tax\TaxInterface
	 */
	public function setCountryCode($countryCode);
	
	/**
	 * @return number
	 */
	public function getValue();
	
	/**
	 * @param number $value
	 * @return \ASF\CommerceBundle\Model\Tax\TaxInterface
	 */
	public function setValue($value);
	
	/**
	 * @return string
	 */
	public function getDescription();
	
	/**
	 * @param string $description
	 * @return \ASF\CommerceBundle\Model\Tax\TaxInterface
	 */
	public function setDescription($description);
	
	/** 
	 * @return string
	 */
	public function getState();
	
	/**
	 * @return boolean
	 */
	public function getIsPourcent();
	
	/**
	 * @param boolean $is_pourcent
	 * @return \ASF\CommerceBundle\Model\Tax\TaxInterface
	*/
	public function setIsPourcent($is_pourcent);
	
	/**
	 * @param string $state
	 * @return \ASF\CommerceBundle\Model\Tax\TaxInterface
	 */
	public function setState($state);
	
	/**
	 * @param \DateTime $date
	 */
	public function getCreatedAt();
	
	/**
	 * @param \DateTime $date
	 * @return \ASF\CommerceBundle\Model\Tax\TaxInterface
	 */
	public function setCreatedAt(\DateTime $date);
	
	/**
	 * @param \DateTime $date
	 */
	public function getUpdatedAt();
	
	/**
	 * @param \DateTime $date
	 * @return \ASF\CommerceBundle\Model\Tax\TaxInterface
	 */
	public function setUpdatedAt(\DateTime $date);
	
	/**
	 * @return \DateTime
	 */
	public function getDeletedAt();
	
	/**
	 * @param \DateTime $date
	 * @return \ASF\CommerceBundle\Model\Tax\TaxInterface
	 */
	public function setDeletedAt(\DateTime $date);
}