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
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use ASF\CommerceBundle\Model\Discount\DiscountModel;

/**
 * Discount Form Type.
 *
 * @author Nicolas Claverie <info@artscore-studio.fr>
 */
class DiscountType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, array(
            'label' => 'asf.commerce.label.discount_name',
            'required' => true
        ))
        ->add('code', TextType::class, array(
            'label' => 'asf.commerce.label.code',
            'required' => false
        ))
        ->add('value', TextType::class, array(
            'label' => 'asf.commerce.label.amount',
            'required' => true
        ))
        ->add('isPourcent', ChoiceType::class, array(
            'label' => 'asf.commerce.label.is_pourcent',
            'choices' => array('asf.commerce.label.yes' => 0, 'asf.commerce.label.no' => 1),
            'required' => true
        ))
        ->add('state', ChoiceType::class, array(
            'label' => 'asf.commerce.label.state',
            'required' => true,
            'choices' => array(
                'asf.commerce.state.draft' => DiscountModel::STATE_DRAFT,
                'asf.commerce.state.published' => DiscountModel::STATE_PUBLISHED
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
        return 'discount_type';
    }
}
