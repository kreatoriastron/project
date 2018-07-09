<?php

namespace LessonsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PresentsController extends Controller
{
    public function showAction()
    {
        return $this->render('LessonsBundle:Default:index.html.twig');
    }

    public function addAction()
    {
        return $this->render('LessonsBundle:Default:index.html.twig');
    }

    public function editAction()
    {
        return $this->render('LessonsBundle:Default:index.html.twig');
    }
}
