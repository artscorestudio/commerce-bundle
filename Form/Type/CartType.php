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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use ASF\CommerceBundle\Model\Cart\CartModel;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

/**
 * Cart Form Type.
 *
 * @author Nicolas Claverie <info@artscore-studio.fr>
 */
class CartType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('discounts', DiscountCollectionType::class)
            ->add('purchasedAt', DateTimeType::class, array(
                'label' => 'asf.commerce.label.purchased_at',
                'date_format' => 'dd-MM-yyyy',
                'date_widget' => 'single_text'
            ))
            ->add('totalInclVAT', MoneyType::class, array(
                'label' => 'asf.commerce.label.total_incl_vat',
                'required' => true,
            ))
            ->add('state', ChoiceType::class, array(
                'label' => 'asf.commerce.label.state',
                'required' => true,
                'choices' => array(
                    'asf.commerce.state.waiting' => CartModel::STATE_WAITING,
                    'asf.commerce.state.validated' => CartModel::STATE_VALIDATED
                )
            ));
    }

    /**
     * (non-PHPdoc).
     *
     * @see \Symfony\Component\Form\FormTypeInterface::getName()
     */
    public function getName()
    {
        return 'cart_type';
    }
}
