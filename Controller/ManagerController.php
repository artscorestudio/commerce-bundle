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

/**
 * Manager Controller gather generic app views.
 * 
 * @Route("/commerce")
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 */
class ManagerController extends Controller
{
    /**
     * Commerce Manager Homepage.
     * 
     * @Route("/", name="asf_commerce_manager_homepage")
     * 
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('ASFCommerceBundle:manager:index.html.twig');
    }
}
