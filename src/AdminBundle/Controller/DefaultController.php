<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AdminBundle:Default:index.html.twig');
    }

    public function addAccountAction()
    {
        return $this->render('AdminBundle:Default:index.html.twig');
    }

    public function editAccountAction()
    {
        return $this->render('AdminBundle:Default:index.html.twig');
    }

    public function assignUserToGroupAction()
    {
        return $this->render('AdminBundle:Default:index.html.twig');
    }

}
