<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ASF\CommerceBundle\Event;

/**
 * Contains all events thrown in the Commerce Bundle.
 *
 * @author Nicolas Claverie <info@artscore-studio.fr>
 */
final class CommerceEvents
{
    /**
     * The LIST_TAXES event occurs at the very beginning of a controller action
     *
     * This event allows you to create custom controls like ACLs, etc. before
     * the execution of the logic of the controller action.
     * 
     * @Event("Symfony\Component\HttpKernel\Event\GetResponseEvent")
     *
     * @var string
     */
    const LIST_TAXES = 'asf.commerce.event.list_taxes';
    
    /**
     * The EDIT_TAXES event occurs at the very beginning of a controller action
     *
     * This event allows you to create custom controls like ACLs, etc. before
     * the execution of the logic of the controller action.
     *
     * @Event("Symfony\Component\HttpKernel\Event\GetResponseEvent")
     *
     * @var string
     */
    const EDIT_TAX = 'asf.commerce.event.edit_tax';
    
    /**
     * The DELETE_TAXES event occurs at the very beginning of a controller action
     *
     * This event allows you to create custom controls like ACLs, etc. before
     * the execution of the logic of the controller action.
     *
     * @Event("Symfony\Component\HttpKernel\Event\GetResponseEvent")
     *
     * @var string
     */
    const DELETE_TAX = 'asf.product.event.delete_tax';
    
    /**
     * The LIST_DISCOUNTS event occurs at the very beginning of a controller action
     *
     * This event allows you to create custom controls like ACLs, etc. before
     * the execution of the logic of the controller action.
     *
     * @Event("Symfony\Component\HttpKernel\Event\GetResponseEvent")
     *
     * @var string
     */
    const LIST_DISCOUNTS = 'asf.commerce.event.list_discounts';
    
    /**
     * The EDIT_DISCOUNT event occurs at the very beginning of a controller action
     *
     * This event allows you to create custom controls like ACLs, etc. before
     * the execution of the logic of the controller action.
     *
     * @Event("Symfony\Component\HttpKernel\Event\GetResponseEvent")
     *
     * @var string
     */
    const EDIT_DISCOUNT = 'asf.commerce.event.edit_discount';
    
    /**
     * The DELETE_DISCOUNT event occurs at the very beginning of a controller action
     *
     * This event allows you to create custom controls like ACLs, etc. before
     * the execution of the logic of the controller action.
     *
     * @Event("Symfony\Component\HttpKernel\Event\GetResponseEvent")
     *
     * @var string
     */
    const DELETE_DISCOUNT = 'asf.commerce.event.delete_discount';
}