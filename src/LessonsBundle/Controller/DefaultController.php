<?php

namespace LessonsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('LessonsBundle:Default:index.html.twig');
    }

    public function cancelLessonAction()
    {
        return $this->render('LessonsBundle:Default:index.html.twig');
    }

    public function showChildsAction()
    {
        return $this->render('LessonsBundle:Default:index.html.twig');
    }

    public function editChildsAction()
    {
        return $this->render('LessonsBundle:Default:index.html.twig');
    }
}
