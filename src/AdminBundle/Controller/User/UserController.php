<?php

namespace AdminBundle\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Service\Uploader\Uploader;

abstract class UserController extends Controller
{
    public function addUserAction()
    {
        return $this->render('AdminBundle:Default:index.html.twig');
    }

    public function addZDOAction()
    {
        return $this->render('AdminBundle:Default:index.html.twig');
    }

    public function addDRAction()
    {
        return $this->render('AdminBundle:Default:index.html.twig');
    }


    public function addParentAction()
    {
        return $this->render('AdminBundle:Default:index.html.twig');
    }

    public function uploadFile($dir, $file, $type = array('image'))
    {
        if(isset($_FILES[$file]['tmp_name']) && is_uploaded_file($_FILES[$file]['tmp_name']))
        {
            $uploader = new Uploader();
            $uploader->setAllowedType($type);
            $uploader->setDestinationDir($dir);
            $uploader->addFile($_FILES[$file]);
            return $uploader->upload();
        }
        return 0;
    }
}
