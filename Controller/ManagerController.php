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

/**
 * Manager Controller gather generic app views.
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 */
class ManagerController extends Controller
{
    /**
     * Commerce Manager Homepage.
     * 
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('ASFCommerceBundle:manager:index.html.twig');
    }
}
