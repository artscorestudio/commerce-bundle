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
use ASF\CommerceBundle\Event\CommerceEvents;
use Symfony\Component\EventDispatcher\Event;
use APY\DataGridBundle\Grid\Source\Entity;
use APY\DataGridBundle\Grid\Action\RowAction;
use ASF\CommerceBundle\Model\Tax\TaxModel;
use Symfony\Component\HttpFoundation\Request;

/**
 * Tax Controller gather generic app views.
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 */
class TaxController extends Controller
{
    /**
     * Tax list.
     * 
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction()
    {
        $this->get('event_dispatcher')->dispatch(CommerceEvents::LIST_TAXES, new Event());
        
        // Set Datagrid source
        $source = new Entity($this->getParameter('asf_commerce.tax.entity'));
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
        $grid->setId('asf_taxes_list');

        // Columns configuration
        $editAction = new RowAction('btn_edit', 'asf_commerce_tax_edit');
        $editAction->setRouteParameters(array('id'));
        $grid->addRowAction($editAction);

        $deleteAction = new RowAction('btn_delete', 'asf_commerce_tax_delete', true);
        $deleteAction->setRouteParameters(array('id'))
            ->setConfirmMessage($this->get('translator')->trans('asf.commerce.msg.delete.confirm', array('%name%' => $this->get('translator')->trans('asf.commerce.default_value.this_tax'))));
        $grid->addRowAction($deleteAction);

        $grid->setNoDataMessage($this->get('translator')->trans('asf.commerce.msg.list.no_tax'));

        return $grid->getGridResponse('ASFCommerceBundle:tax:list.html.twig');
    }
    
    /**
     * Add or edit a tax.
     * 
     * @param Request $request
     * @param int     $id      ASFCommerceBundle:Tax Entity ID
     *
     * @throws \Exception Error on tax not found
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, $id = null)
    {
        $this->get('event_dispatcher')->dispatch(CommerceEvents::EDIT_TAX, new Event());
    
        $formFactory = $this->get('asf_commerce.form.factory.tax');
    
        if (!is_null($id)) {
            $tax = $this->getDoctrine()->getRepository($this->getParameter('asf_commerce.tax.entity'))->findOneBy(array('id' => $id));
        } else {
            $tax = $this->get('asf_commerce.manager')->createTaxInstance();
            $tax->setName($this->get('translator')->trans('asf.commerce.default_value.tax_name'))
            ->setState(TaxModel::STATE_PUBLISHED);
        }
    
        if (is_null($tax)) {
            throw new \Exception($this->get('translator')->trans('asf.commerce.msg.error.tax_not_found'));
        }
    
        $form = $formFactory->createForm();
        $form->setData($tax);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $tax = $form->getData();
                if (is_null($tax->getId())) {
                    $this->get('doctrine.orm.default_entity_manager')->persist($tax);
                    $success_message = $this->get('translator')->trans('asf.commerce.msg.success.tax_created', array('%name%' => $tax->getName()));
                } else {
                    $success_message = $this->get('translator')->trans('asf.commerce.msg.success.tax_updated', array('%name%' => $tax->getName()));
                }
    
                $this->get('doctrine.orm.default_entity_manager')->flush();
    
                if ($this->has('asf_layout.flash_message')) {
                    $this->get('asf_layout.flash_message')->success($success_message);
                }
    
                return $this->redirect($this->get('router')->generate('asf_commerce_tax_edit', array('id' => $tax->getId())));
            } catch (\Exception $e) {
                if ($this->has('asf_layout.flash_message')) {
                    $this->get('asf_layout.flash_message')->danger($e->getMessage());
                } else {
                    return $e;
                }
            }
        }
    
        return $this->render('ASFCommerceBundle:tax:edit.html.twig', array(
            'tax' => $tax,
            'form' => $form->createView(),
        ));
    }
    
    /**
     * Delete a tax.
     * 
     * @param int $id ASFProductBundle:Tax Entity ID
     *
     * @throws \Exception Error on tax not found or on removing element from DB
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction($id)
    {
        $this->get('event_dispatcher')->dispatch(CommerceEvents::DELETE_TAX, new Event());
    
        $tax = $this->getDoctrine()->getRepository($this->getParameter('asf_commerce.tax.entity'))->findOneBy(array('id' => $id));
        
        if (is_null($tax)) {
            throw new \Exception($this->get('translator')->trans('asf.commerce.msg.error.tax_not_found'));
        }
        
        try {
            $tax->setState(TaxModel::STATE_DELETED);
            $this->get('doctrine.orm.default_entity_manager')->flush();
    
            if ($this->has('asf_layout.flash_message')) {
                $this->get('asf_layout.flash_message')->success($this->get('translator')->trans('asf.commerce.msg.success.tax_deleted', array('%name%' => $tax->getName())));
            }
        } catch (\Exception $e) {
            if ($this->has('asf_layout.flash_message')) {
                $this->get('asf_layout.flash_message')->danger($e->getMessage());
            } else {
                return $e;
            }
        }
    
        return $this->redirect($this->get('router')->generate('asf_commerce_taxes_list'));
    }
}
