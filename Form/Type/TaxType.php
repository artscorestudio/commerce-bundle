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
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use ASF\CommerceBundle\Model\Tax\TaxModel;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

/**
 * Tax Form Type.
 *
 * @author Nicolas Claverie <info@artscore-studio.fr>
 */
class TaxType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, array(
            'label' => 'asf.commerce.label.tax_name',
            'required' => true
        ))
        
        ->add('countryCode', CountryType::class, array(
            'label' => 'asf.commerce.label.country',
            'required' => true,
            'preferred_choices' => array('FR')
        ))
        
        ->add('value', TextType::class, array(
            'label' => 'asf.commerce.label.tax_rate',
            'required' => true
        ))
        ->add('description', TextareaType::class, array(
            'label' => 'asf.commerce.label.tax_description',
            'required' => true
        ))
        
        ->add('state', ChoiceType::class, array(
            'label' => 'asf.commerce.label.state',
            'required' => true,
            'choices' => array(
                'asf.commerce.state.draft' => TaxModel::STATE_DRAFT,
                'asf.commerce.state.published' => TaxModel::STATE_PUBLISHED
            ),
        ));
    }

    /**
     * (non-PHPdoc).
     *
     * @see \Symfony\Component\Form\FormTypeInterface::getName()
     */
    public function getName()
    {
        return 'tax_type';
    }
}
