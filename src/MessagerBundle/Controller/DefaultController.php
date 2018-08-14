<?php

namespace MessagerBundle\Controller;

use AppBundle\Entity\Messanger;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

    public function indexAction()
    {
        return $this->render('MessagerBundle:Default:index.html.twig');
    }

    public function sendAction()
    {
        return $this->render('MessagerBundle:Default:index.html.twig');
    }

    public function sendSMSAction()
    {
        return $this->render('MessagerBundle:Default:index.html.twig');
    }

    public function sendMessageAction()
    {
        return $this->render('MessagerBundle:Default:index.html.twig');
    }

    public function reciveAction()
    {
        return $this->render('MessagerBundle:Default:index.html.twig');
    }

    public function checkNewMessagesAction()
    {
        return $this->render('MessagerBundle:Default:index.html.twig');
    }

}
