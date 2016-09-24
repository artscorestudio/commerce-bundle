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
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

/**
 * Search Tax Type.
 *
 * @author Nicolas Claverie <info@artscore-studio.fr>
 */
class SearchTaxType extends AbstractType
{
    /**
     * @var string
     */
    protected $className;
    
    /**
     * @param string $className
     */
    public function __construct($className)
    {
        $this->className = $className;
    }
    
    /**
     * {@inheritDoc}
     * @see \Symfony\Component\Form\AbstractType::configureOptions()
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'label' => 'asf.commerce.label.search_tax',
            'class' => $this->className,
            'choice_label' => 'name',
            'placeholder' => 'asf.commerce.label.choose_a_tax',
            'multiple' => true,
            'attr' => array('class' => 'select2-entity'),
        ));
    }
    
    /**
     * (non-PHPdoc).
     *
     * @see \Symfony\Component\Form\FormTypeInterface::getName()
     */
    public function getBlockPrefix()
    {
        return 'search_tax';
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }
    
    /**
     * (non-PHPdoc)
     * @see \Symfony\Component\Form\AbstractType::getParent()
     */
    public function getParent()
    {
    	return EntityType::class;
    }
}
