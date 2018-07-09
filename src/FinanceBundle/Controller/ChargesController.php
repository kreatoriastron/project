<?php

namespace FinanceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ChargesController extends Controller
{
    public function indexAction()
    {
        return $this->render('FinanceBundle:Default:index.html.twig');
    }

    public function addInvoiceAction()
    {
        return $this->render('FinanceBundle:Default:index.html.twig');
    }
}
