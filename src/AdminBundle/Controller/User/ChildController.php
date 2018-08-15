<?php

namespace AdminBundle\Controller\User;

use AdminBundle\Controller\User\UserController;
use AppBundle\Entity\AppUsers;
use AppBundle\Entity\Child;
use AppBundle\Entity\ChildToGroup;
use AppBundle\Entity\City;
use AppBundle\Entity\GroupList;
use AppBundle\Entity\LessonSelectedToChild;
use AppBundle\Entity\Messanger;
use AppBundle\Entity\School;
use AppBundle\Entity\UserLector;
use FOS\UserBundle\Model\User;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\UserParent;
use AppBundle\Service\FormManager\FormManager;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Service\DBManager\FilterManager;

class ChildController extends UserController
{
    public function addAction(Request $request)
    {
        $name = $request->request->get('name');

        if ($name)
        {
            $userId = $this->save($request->request);
            return $this->render('AdminBundle:User\Parent:success.html.twig', array(
                'userId' => $userId));
        }

        $cities = $this->getCities();


        return $this->render('AdminBundle:User\Parent:add.html.twig', array(
                'action_url' => 'add_parent',
                'cities' => $cities));
    }

    private function getCities()
    {
        $results = $this->getDoctrine()
            ->getRepository(City::class)
            ->createQueryBuilder('c')
            ->select('c')
            ->getQuery()
            ->getResult();
        $cities = array();

        foreach($results as $id => $city)
        {
            $cities[] = array(
                'id' => $city->getId(),
                'city' => $city->getCity(),
                'wojewodztwo' => $city->getWojewodztwo()->getName()
            );
        }

        return $cities;
    }


    private function save($data)
    {
        $entityManager = $this->getDoctrine()->getManager();

        try {
            $plainPass = $rand = substr(md5(microtime()),rand(0,26),7);
            $pass = password_hash($plainPass, PASSWORD_BCRYPT);

            $appUser = new AppUsers();
            $appUser->setUsername($data->get('phone'));
            $appUser->setPassword($pass);
            $appUser->setEmail($data->get('email'));
            $appUser->setRole(1);
            $appUser->setName($data->get('name'));
            $appUser->setIsActive(1);
            $appUser->setSurname($data->get('surname'));
            $appUser->setPhone($data->get('phone'));
            $entityManager->persist($appUser);
            $entityManager->flush();
        } catch (Exception $e)
        {
            throw new Exception($e->getMessage());
            return $e->getMessage();
        }

        try {
            $time = strtotime($data->get('ending_date'));

            $user = new UserParent();
            $user->setUser($appUser);
            $newFileName = $this->uploadFile('parent_contract', 'contract');
            $user->setContractFile($newFileName);
            $user->setRaCity($data->get('ra_city'));
            $user->setRaZipCode($data->get('ra_zip_code'));
            $user->setRaStreet($data->get('ra_street'));
            $user->setRaBuilding($data->get('ra_building'));
            $user->setRaApartment($data->get('ra_apartment'));
            $user->setCaCity($data->get('ca_city'));
            $user->setCaZipCode($data->get('ca_zip_code'));
            $user->setCaStreet($data->get('ca_street'));
            $user->setCaBuilding($data->get('ca_building'));
            $user->setCaApartment($data->get('ca_apartment'));
            $entityManager->persist($user);
            $entityManager->flush();
            $newUserId = $user->getId();
        } catch (Exception $e)
        {
            throw new Exception($e->getMessage());
            return $e->getMessage();
        }

        try {
            $schoolId = $data->get('school');
            $school = $this->getDoctrine()
                ->getRepository(School::class)
                ->findOneById($schoolId);

            $child = new Child();
            $child->setName($data->get('child_name'));
            $child->setSurname($data->get('child_surname'));
            $child->setParent($user);
            $child->setSchool($school);
            $child->setClassDigit($data->get('class_digit'));
            $child->setClassLetter($data->get('class_letter'));
            $entityManager->persist($child);
            $entityManager->flush();

            $messenger = new Messanger();
            $messenger->setFromUser('csatut');
            $messenger->setToUser($appUser->getId());
            $messenger->setMessage('Wiadomość powitalna. Twoje hasło to: ' . $plainPass);
            $messenger->setSendDate(new \DateTime('NOW'));
            $messenger->setStatus('0');
            $messenger->setType('1');
            $entityManager->persist($messenger);
            $entityManager->flush();
        } catch (Exception $e)
        {
            throw new Exception($e->getMessage());
            return $e->getMessage();
        }
        return $newUserId;
    }

    public function updateAction(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $data = $request->request;
        $userId = $data->get('userId');

        $child = $this->getDoctrine()
            ->getRepository(Child::class)
            ->findOneById($userId);

        if (!$child) {
            throw $this->createNotFoundException(
                'No user found for id '.$userId
            );
        }

        try {
            $child->setName($data->get('name'));
            $child->setSurname($data->get('surname'));
            $child->setClassDigit($data->get('class_digit'));
            $child->setClassLetter($data->get('class_letter'));
            $entityManager->persist($child);
            $entityManager->flush();
        } catch (Exception $e)
        {
            throw new Exception($e->getMessage());
            return $e->getMessage();
        }

        return new Response('correct');
    }

    public function editProfileAction($userId)
    {
        $child = $this->getDoctrine()
            ->getRepository(Child::class)
            ->findOneById($userId);

        $schoolData = array('name' => '', 'id' => '');
        if($child instanceof Child)
        {
            $schoolData['name'] = $child->getSchool()->getName();
            $schoolData['id'] = $child->getSchool()->getId();
        }

        $group = $this->getGroup($child->getId());
        $groupData = array('name' => '', 'id' => '');
        if($group instanceof GroupList)
        {
            $groupData['name'] = $group->getName();
            $groupData['id'] = $group->getId();
        }

        $userArr = array(
            'id' => $child->getId(),
            'name' => $child->getName(),
            'surname' => $child->getSurname(),
            'parentName' => $child->getParent()->getUser()->getName(),
            'parentSurname' => $child->getParent()->getUser()->getSurname(),
            'parentId' => $child->getParent()->getUser()->getId(),
            'class_digit' => $child->getClassDigit(),
            'class_letter' => $child->getClassLetter(),
        );

        $lstc = $this->getDoctrine()
            ->getRepository(LessonSelectedToChild::class)
            ->findByChild($child);

        $lessonList = array();
        foreach($lstc as $id => $row)
        {
            $lessonList[$id]['day'] = $row->getGroupLesson()->getDay()->getName();
            $lessonList[$id]['hour'] = $row->getGroupLesson()->getHour();
            $lessonList[$id]['status'] = $row->getStatus();
            $lessonList[$id]['id'] = $row->getId();
        }

        return $this->render('AdminBundle:User\Child:edit.html.twig', array(
            'action_url' => 'update_child',
            'userArr' => $userArr,
            'school' => $schoolData,
            'group' => $groupData,
            'lstc' => $lessonList));
    }

    public function showProfileAction($userId)
    {
        $parent = $this->getDoctrine()
            ->getRepository(UserParent::class)
            ->findOneById($userId);

        $userArr = array(
            'name' => $parent->getUser()->getName(),
            'surname' => $parent->getUser()->getSurname(),
            'email' => $parent->getUser()->getEmail(),
            'phone' => $parent->getUser()->getPhone(),
            'contract' => $parent->getContractFile(),
            'id' => $parent->getId(),
            'ra_city' => $parent->getRaCity(),
            'ra_zip_code' => $parent->getRaZipCode(),
            'ra_street' => $parent->getRaStreet(),
            'ra_building' => $parent->getRaBuilding(),
            'ra_apartment' => $parent->getRaApartment(),
            'ca_city' => $parent->getCaCity(),
            'ca_zip_code' => $parent->getCaZipCode(),
            'ca_street' => $parent->getCaStreet(),
            'ca_building' => $parent->getCaBuilding(),
            'ca_apartment' => $parent->getCaApartment(),
        );

        return $this->render('AdminBundle:User\Parent:showProfile.html.twig', array(
            'userArr' => $userArr));
    }

    public function showAction()
    {
        $result = $this->getDoctrine()
            ->getRepository(Child::class)
            ->createQueryBuilder('u')
            ->select('u')
            ->getQuery()
            ->getResult();

        $rows = array();
        foreach($result as $id => $row)
        {
            $group = $this->getGroup($row->getId());
            $groupName = $this->getGroupName($group);

            $rows[] = array(
                'id' => $row->getId(),
                'name' => $row->getName(),
                'surname' => $row->getSurname(),
                'parentName' => $row->getParent()->getUser()->getName(),
                'parentSurname' => $row->getParent()->getUser()->getSurname(),
                'parentId' => $row->getParent()->getId(),
                'school' => $row->getSchool()->getName(),
                'schoolId' => $row->getSchool()->getId(),
                'class' => $row->getClassDigit() . $row->getClassLetter(),
                'group' => $groupName,
            );
        }

        return $this->render('AdminBundle:User\Child:show.html.twig', array(
            'users' => $rows));
    }

    private function getGroup($childId)
    {
        $ctg = $this->getDoctrine()
            ->getRepository(ChildToGroup::class)
            ->findOneByChild($childId);

        if(is_object($ctg)) {
            return $ctg->getGrouplist();
        }

        return 0;
    }
    private function getGroupName($group)
    {
        if($group instanceof GroupList)
        {
            return $group->getName();
        }

        return '';
    }

    public function filterAction(Request $request)
    {
        $data = $request->request->all();

        $dataChild = array(
            'name' => $data['name'],
            'surname' => $data['surname'],
            'classDigit_or_first' => $data['class'],
            'classLetter_or_first' => $data['class']
        );

        $conditionClass['classDigit_or_first'] = 'OR';
        $conditionClass['classLetter_or_first'] = 'OR';

        $dataParent = array(
            'name' => $data['parent_name'],
            'surname' => $data['parent_surname']
        );
        $dataSchool = array(
            'name' => $data['school']
        );
        $filterManager = new FilterManager($this->getDoctrine());
        $filterManager->setTable(array(
            'fullName' =>'AppBundle\Entity\Child',
            'shortName' => 'c'));
        $filterManager->setJoin(array(
            'c.parent' => 'p'));
        $filterManager->setJoin(array(
            'p.user' => 'u'));
        $filterManager->setJoin(array(
            'c.school' => 's'));
        $filterManager->setCondition($dataChild, 'c', $conditionClass);
        $filterManager->setCondition($dataParent, 'u');
        $filterManager->setCondition($dataSchool, 's');
        $filterManager->setSelect(array('c'));
        $filteredData = $filterManager->getfilteredData();

        $rows = array();
        foreach($filteredData as $id => $row)
        {
            $rows[$row->getId()] = array(
                'id' => $row->getId(),
                'name' => $row->getName(),
                'surname' => $row->getSurname(),
                'parentName' => $row->getParent()->getUser()->getName(),
                'parentSurname' => $row->getParent()->getUser()->getSurname(),
                'school' => $row->getSchool()->getName(),
                'class' => $row->getClassDigit() . $row->getClassLetter()
            );
        }

        if(strlen($data['group']))
        {
            $searchByGroup = array(
                'child' => array_keys($rows),
                'group' => $request->request->get('group'),
            );
            $filteredByGroup = $this->filterByGroup($searchByGroup);

            $filteredData = array();
            foreach ($filteredByGroup as $id => $groupData) {
                $data = $rows[$id];
                $data['group'] = $groupData;
                $filteredData[] = $data;
            }

            $jsonData = json_encode($filteredData);
        } else {
            $jsonData = json_encode($rows);
        }

        return new Response($jsonData);
    }

    private function filterByGroup($data)
    {
        $dataGroupList = array(
            'name' => $data['group']);

        $dataChildToGroup = array(
            'child' => $data['child']
        );
        $condition['child'] = 'IN';

        $filterManager = new FilterManager($this->getDoctrine());
        $filterManager->setTable(array(
            'fullName' =>'AppBundle\Entity\ChildToGroup',
            'shortName' => 'ctg'));
        $filterManager->setJoin(array(
            'ctg.grouplist' => 'gl'));
        $filterManager->setCondition($dataChildToGroup, 'ctg', $condition);
        $filterManager->setCondition($dataGroupList, 'gl');
        $filterManager->setSelect(array('IDENTITY(ctg.child) as child, gl.name as group'));
        $filteredData = $filterManager->getfilteredData();

        $output = array();
        foreach($filteredData as $id => $data)
        {
            $output[$data['child']] = $data['group'];
        }

        return $output;
    }

    public function changeLstcAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $data = $request->request->all();

        foreach($data as $id => $value)
        {
            $lstc =  $this->getDoctrine()
                ->getRepository(LessonSelectedToChild::class)
                ->findOneById($id);

            if($lstc instanceof LessonSelectedToChild)
            {
                $value = ($value == 'on') ? 1 : 0;

                $lstc->setStatus($value);
                $em ->persist($lstc);
            }
        }
        $em->flush();

        return new Response('correct');
    }
}
