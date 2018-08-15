<?php

namespace MessagerBundle\Controller;

use AppBundle\Entity\GroupList;
use AppBundle\Entity\LectorToDr;
use AppBundle\Entity\UserDr;
use AppBundle\Entity\UserLector;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Service\DBManager\FilterManager;

class MessageLectorController extends MessageController
{
    private $userList;
    private $schoolArr;
    private $groupArr;
    private $dr;

    public function createAction()
    {
        $userList = $this->getList();

        foreach($userList as $id => $lector)
        {
            $drName = '';
            $drSurname = '';
            $dr = $this->getDrToLector($lector);
            $this->setSchoolAndGroup($lector);
            if(null !== $dr)
            {
                $drName = $dr->getUser()->getName();
                $drSurname = $dr->getUser()->getSurname();
            }
            $this->userList[] = array(
                'name' => $lector->getUser()->getName(),
                'surname' => $lector->getUser()->getSurname(),
                'email' => $lector->getUser()->getEmail(),
                'phone' => $lector->getUser()->getPhone(),
                'id' => $lector->getUser()->getId(),
                'dr' => $drName . ' ' . $drSurname,
                'groups' => implode(',', $this->groupArr),
                'school' => implode(',', $this->schoolArr)
            );
        }

        return $this->render('MessagerBundle:Message:lector_create.html.twig', array(
            'users' => $this->userList
        ));
    }

    private function getList()
    {
        $list = $this->getDoctrine()
            ->getRepository(UserLector::class)
            ->findAll();

        return $list;
    }

    private function getDrToLector($lector)
    {
        $ltd = $this->getDoctrine()
            ->getRepository(LectorToDr::class)
            ->findOneByUserLector($lector);
        $dr = (method_exists($ltd,'getUserDr')) ? $ltd->getUserDr() : null;

        return $dr;
    }

    private function setSchoolAndGroup($lector)
    {
        $this->schoolArr = array();
        $this->groupArr = array();

        $groups = $this->getDoctrine()
            ->getRepository(GroupList::class)
            ->findByUserLector($lector);

        foreach($groups as $id => $group)
        {
            $this->schoolArr[] = $group->getSchool()->getName();
            $this->groupArr[] = $group->getName();
        }

        return 1;
    }

    public function filterAction(Request $request)
    {
        $data = $request->request->all();
        $filterBygroup = $this->checkFilterByGroup($data['school'], $data['group']);
        unset($data['group']);
        unset($data['school']);
        $data['name_or_first'] = $data['dr'];
        $data['surname_or_first'] = $data['dr'];
        unset($data['dr']);

        $condition['name_or_first'] = 'OR';
        $condition['surname_or_first'] = 'OR';

        $filterManager = new FilterManager($this->getDoctrine());
        $filterManager->setTable(array(
            'fullName' =>'AppBundle\Entity\UserLector',
            'shortName' => 'ul'));
        $filterManager->setJoin(array(
            'ul.user' => 'au'));
        $filterManager->setJoin(array(
            'ul.ltd' => 'ltd'));
        $filterManager->setJoin(array(
            'ltd.userDr' => 'ud'));
        $filterManager->setJoin(array(
            'ud.user' => 'au2'));
        $filterManager->setCondition($data, 'au2', $condition);
        $filterManager->setSelect(array('ul'));
        $filteredData = $filterManager->getfilteredData();

        $rows = array();
        foreach($filteredData as $id => $row)
        {
            $this->setSchoolAndGroup($row->getId());
            $drName = '';
            $drSurname = '';
            $ltd = $this->getDoctrine()
                ->getRepository(LectorToDr::class)
                ->findOneByUserLector($row);
            if(is_object($ltd)) {
                $drName = $ltd->getUserDr()->getUser()->getName();
                $drSurname = $ltd->getUserDr()->getUser()->getSurname();
            }

            $this->setSchoolAndGroup($row->getId());
            $rows[$row->getId()] = array(
                'id' => $row->getUser()->getId(),
                'name' => $row->getUser()->getName(),
                'surname' => $row->getUser()->getSurname(),
                'email' => $row->getUser()->getEmail(),
                'phone' => $row->getUser()->getPhone(),
                'dr'  => $drName . ' ' . $drSurname,
                'groups' => implode(',', $this->groupArr),
                'school' => implode(',', $this->schoolArr)

            );
        }

        if($filterBygroup) {
            $searchByGroup = array(
                'userLector' => array_keys($rows),
                'group' => $request->request->get('group'),
                'school' => $request->request->get('school')
            );
            $filteredByGroup = $this->filterByGroup($searchByGroup);

            $filteredData = array();
            foreach ($filteredByGroup as $id => $groupData) {
                $data = $rows[$id];
                $data['group'] = implode(',', $groupData['group']);
                $data['school'] = implode(',', $groupData['school']);
                $filteredData[] = $data;
            }

            $jsonData = json_encode($filteredData);
        } else {
            $jsonData = json_encode($rows);
        }

        return new Response($jsonData);
    }

    private function checkFilterByGroup($school, $group)
    {
        if(strlen($school) || strlen($group))
        {
            return 1;
        } else {
            return 0;
        }
    }

    private function filterByGroup($data)
    {
        $dataSchool = array(
            'name' => $data['school']);

        $dataGroup = array(
            'name' => $data['group'],
            'userLector' => $data['userLector']
        );
        $condition['userLector'] = 'IN';

        $filterManager = new FilterManager($this->getDoctrine());
        $filterManager->setTable(array(
            'fullName' =>'AppBundle\Entity\GroupList',
            'shortName' => 'g'));
        $filterManager->setJoin(array(
            'g.school' => 's'));
        $filterManager->setCondition($dataGroup, 'g', $condition);
        $filterManager->setCondition($dataSchool, 's');
        $filterManager->setSelect(array('IDENTITY(g.userLector) as lector, g.name as group, s.name as school'));
        $filteredData = $filterManager->getfilteredData();

        $output = array();
        foreach($filteredData as $id => $data)
        {
            $output[$data['lector']]['school'][] = $data['school'];
            $output[$data['lector']]['group'][] = $data['group'];
        }

        return $output;
    }

}
