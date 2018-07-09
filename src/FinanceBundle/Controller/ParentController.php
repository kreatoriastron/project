<?php

namespace FinanceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ParentController extends Controller
{
    public function indexAction()
    {
        return $this->render('FinanceBundle:Default:index.html.twig');
    }

    public function showUnrecognizedPaymentsAction()
    {
        return $this->render('FinanceBundle:Default:index.html.twig');
    }

    public function addPaymentsToParentAction()
    {
        return $this->render('FinanceBundle:Default:index.html.twig');
    }
}
