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

use Doctrine\ORM\EntityManagerInterface;

/**
 * Commerce Entity Manager.
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 */
class CommerceManager implements CommerceManagerInterface
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var string
     */
    protected $cartClassName;

    /**
     * @var string
     */
    protected $catalogClassName;

    /**
     * @var string
     */
    protected $discountClassName;
    
    /**
     * @var string
     */
    protected $taxClassName;

    /**
     * @param EntityManagerInterface $em
     * @param string                 $cartClassName
     * @param string                 $catalogClassName
     * @param string                 $discountClassName
     * @param string                 $taxClassName
     */
    public function __construct(EntityManagerInterface $em, $cartClassName, $catalogClassName, $discountClassName, $taxClassName)
    {
        $this->em = $em;
        $this->cartClassName = $cartClassName;
        $this->catalogClassName = $catalogClassName;
        $this->discountClassName = $discountClassName;
        $this->taxClassName = $taxClassName;
    }

    /**
     * Create a Cart Instance.
     * 
     * @return object
     */
    public function createCartInstance()
    {
        $class = new \ReflectionClass($this->cartClassName);

        return $class->newInstanceArgs();
    }

    /**
     * Create a Catalog Instance.
     * 
     * @return object
     */
    public function createCatalogInstance()
    {
        $class = new \ReflectionClass($this->catalogClassName);

        return $class->newInstanceArgs();
    }

    /**
     * Create a Discount Instance.
     * 
     * @return object
     */
    public function createDiscountInstance()
    {
        $class = new \ReflectionClass($this->discountClassName);

        return $class->newInstanceArgs();
    }
    
    /**
     * Create a Tax Instance.
     *
     * @return object
     */
    public function createTaxInstance()
    {
        $class = new \ReflectionClass($this->taxClassName);
    
        return $class->newInstanceArgs();
    }
    
    public function createCatalogInstalce()
    {
        if ( null === $this->catalogClassName )
            throw new \Exception('The entity Catalog was not enabled in ASFCommerceBundle.');
        
        $class = new \ReflectionClass($this->catalogClassName);
        
        return $class->newInstanceArgs();
    }
}
