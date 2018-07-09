<?php

namespace FinanceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EmployeeController extends Controller
{
    public function indexAction()
    {
        return $this->render('FinanceBundle:Default:index.html.twig');
    }

    public function addBonusAction()
    {
        return $this->render('FinanceBundle:Default:index.html.twig');
    }

    public function addDelegationAction()
    {
        return $this->render('FinanceBundle:Default:index.html.twig');
    }
}
