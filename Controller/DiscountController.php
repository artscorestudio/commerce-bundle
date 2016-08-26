<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ASF\CommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ASF\CommerceBundle\Model\Discount\DiscountModel;
use ASF\CommerceBundle\Event\CommerceEvents;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Request;
use APY\DataGridBundle\Grid\Source\Entity;
use APY\DataGridBundle\Grid\Action\RowAction;

/**
 * Discount Controller gather generic app views.
 * 
 * @Route("/commerce/discount")
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 */
class DiscountController extends Controller
{
    /**
     * Discount list.
     * 
     * @Route("/", name="asf_commerce_discounts_list")
     * 
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function lisAction()
    {
        $this->get('event_dispatcher')->dispatch(CommerceEvents::LIST_DISCOUNTS, new Event());
        
        // Set Datagrid source
        $source = new Entity($this->getParameter('asf_commerce.discount.entity'));
        $tableAlias = $source->getTableAlias();
        $source->manipulateQuery(function ($query) use ($tableAlias) {
            $query instanceof QueryBuilder;

            if (count($query->getDQLPart('orderBy')) == 0) {
                $query->orderBy($tableAlias.'.name', 'ASC');
            }
        });

        // Get Grid instance
        $grid = $this->get('grid');
        $grid instanceof Grid;

        // Attach the source to the grid
        $grid->setSource($source);
        $grid->setId('asf_discounts_list');

        // Columns configuration
        $editAction = new RowAction('btn_edit', 'asf_commerce_discount_edit');
        $editAction->setRouteParameters(array('id'));
        $grid->addRowAction($editAction);

        $deleteAction = new RowAction('btn_delete', 'asf_commerce_discount_delete', true);
        $deleteAction->setRouteParameters(array('id'))
            ->setConfirmMessage($this->get('translator')->trans('asf.commerce.msg.delete.confirm', array('%name%' => $this->get('translator')->trans('asf.commerce.default_value.this_discount'))));
        $grid->addRowAction($deleteAction);

        $grid->setNoDataMessage($this->get('translator')->trans('asf.commerce.msg.list.no_discount'));

        return $grid->getGridResponse('ASFCommerceBundle:discount:list.html.twig');
    }

    /**
     * Add or edit a discount.
     * 
     * @Route("/commerce/discount/add", name="asf_commerce_discount_add")
     * @Route("/commerce/discount/edit/{id}", name="asf_commerce_discount_edit")
     * 
     * @param Request $request
     * @param int     $id      ASFCommerceBundle:Discount Entity ID
     *
     * @throws \Exception Error on discount not found
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, $id = null)
    {
        $this->get('event_dispatcher')->dispatch(CommerceEvents::EDIT_DISCOUNT, new Event());
    
        $formFactory = $this->get('asf_commerce.form.factory.discount');
    
        if (!is_null($id)) {
            $discount = $this->getDoctrine()->getRepository($this->getParameter('asf_commerce.discount.entity'))->findOneBy(array('id' => $id));
        } else {
            $discount = $this->get('asf_commerce.manager')->createDiscountInstance();
            $discount->setName($this->get('translator')->trans('asf.commerce.default_value.discount_name'))
            ->setState(DiscountModel::STATE_PUBLISHED);
        }
    
        if (is_null($discount)) {
            throw new \Exception($this->get('translator')->trans('asf.commerce.msg.error.discount_not_found'));
        }
    
        $form = $formFactory->createForm();
        $form->setData($discount);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $discount = $form->getData();
                if (is_null($discount->getId())) {
                    $this->get('doctrine.orm.default_entity_manager')->persist($discount);
                    $success_message = $this->get('translator')->trans('asf.commerce.msg.success.discount_created', array('%name%' => $discount->getName()));
                } else {
                    $success_message = $this->get('translator')->trans('asf.commerce.msg.success.discount_updated', array('%name%' => $discount->getName()));
                }
    
                $this->get('doctrine.orm.default_entity_manager')->flush();
    
                if ($this->has('asf_layout.flash_message')) {
                    $this->get('asf_layout.flash_message')->success($success_message);
                }
    
                return $this->redirect($this->get('router')->generate('asf_commerce_discount_edit', array('id' => $discount->getId())));
            } catch (\Exception $e) {
                if ($this->has('asf_layout.flash_message')) {
                    $this->get('asf_layout.flash_message')->danger($e->getMessage());
                } else {
                    return $e;
                }
            }
        }
    
        return $this->render('ASFCommerceBundle:discount:edit.html.twig', array(
            'discount' => $discount,
            'form' => $form->createView(),
        ));
    }
    
    /**
     * Delete a discount.
     * 
     * @Route("/commerce/discounr/delete/{id}", name="asf_commerce_discount_delete")
     * 
     * @param int $id ASFProductBundle:Tax Entity ID
     *
     * @throws \Exception Error on discount not found or on removing element from DB
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction($id)
    {
        $this->get('event_dispatcher')->dispatch(CommerceEvents::DELETE_DISCOUNT, new Event());
    
        $discount = $this->getDoctrine()->getRepository($this->getParameter('asf_commerce.discount.entity'))->findOneBy(array('id' => $id));
    
        if (is_null($discount)) {
            throw new \Exception($this->get('translator')->trans('asf.commerce.msg.error.discount_not_found'));
        }
    
        try {
            $discount->setState(DiscountModel::STATE_DELETED);
            $this->get('doctrine.orm.default_entity_manager')->flush();
    
            if ($this->has('asf_layout.flash_message')) {
                $this->get('asf_layout.flash_message')->success($this->get('translator')->trans('asf.commerce.msg.success.discount_deleted', array('%name%' => $discount->getName())));
            }
        } catch (\Exception $e) {
            if ($this->has('asf_layout.flash_message')) {
                $this->get('asf_layout.flash_message')->danger($e->getMessage());
            } else {
                return $e;
            }
        }
    
        return $this->redirect($this->get('router')->generate('asf_commerce_discounts_list'));
    }
}
