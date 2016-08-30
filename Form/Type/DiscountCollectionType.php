<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ASF\CommerceBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

/**
 * Discount Form Type.
 *
 * @author Nicolas Claverie <info@artscore-studio.fr>
 */
class DiscountCollectionType extends AbstractType
{
    /**
     * @var string
     */
    protected $discountClassName;
    
    /**
     * @param string $discountClassName
     */
    public function __construct($discountClassName)
    {
        $this->discountClassName = $discountClassName;
    }
    
    /**
     * {@inheritDoc}
     * @see \Symfony\Component\Form\AbstractType::configureOptions()
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'label' => 'asf.commerce.label.discounts_list',
            'entry_type' => EntityType::class,
            'entry_options' => array(
                'class' => $this->discountClassName,
                'placeholder' => 'asf.commerce.label.choose_discount'
            ),
            'allow_add' => true,
            'allow_delete' => true,
            'prototype' => true,
            'prototype_name' => '__dsname__'
        ));
    }
    
    /**
     * (non-PHPdoc)
     * @see \Symfony\Component\Form\AbstractType::getParent()
     */
    public function getParent()
    {
    	return CollectionType::class;
    }
    
    /**
     * (non-PHPdoc).
     *
     * @see \Symfony\Component\Form\FormTypeInterface::getName()
     */
    public function getName()
    {
        return 'discount_collection_type';
    }
}
