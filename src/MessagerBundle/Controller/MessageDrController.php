<?php

namespace MessagerBundle\Controller;

use AppBundle\Entity\UserDr;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Service\DBManager\FilterManager;

class MessageDrController extends MessageController
{
    private $userList;

    public function createAction()
    {
        $userList = $this->getList();

        foreach($userList as $id => $dr)
        {
            $this->userList[] = array(
                'name' => $dr->getUser()->getName(),
                'surname' => $dr->getUser()->getSurname(),
                'email' => $dr->getUser()->getEmail(),
                'phone' => $dr->getUser()->getPhone(),
                'id' => $dr->getUser()->getId()
            );
        }

        return $this->render('MessagerBundle:Message:dr_create.html.twig', array(
            'users' => $this->userList
        ));
    }

    private function getList()
    {
        $list = $this->getDoctrine()
            ->getRepository(UserDr::class)
            ->findAll();

        return $list;
    }


    public function filterAction(Request $request)
    {
        $data = $request->request->all();

        $filterManager = new FilterManager($this->getDoctrine());
        $filterManager->setTable(array(
            'fullName' =>'AppBundle\Entity\UserDr',
            'shortName' => 'ul'));
        $filterManager->setJoin(array(
            'ul.user' => 'au'));
        $filterManager->setCondition($data, 'au');
        $filterManager->setSelect(array('ul'));
        $filteredData = $filterManager->getfilteredData();

        $rows = array();
        foreach($filteredData as $id => $row)
        {
            $rows[$row->getId()] = array(
                'id' => $row->getUser()->getId(),
                'name' => $row->getUser()->getName(),
                'surname' => $row->getUser()->getSurname(),
                'email' => $row->getUser()->getEmail(),
                'phone' => $row->getUser()->getPhone()
            );
        }
        $jsonData = json_encode($rows);

        return new Response($jsonData);
    }
}
