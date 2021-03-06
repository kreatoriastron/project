<?php

namespace AdminBundle\Controller\User;

use AdminBundle\Controller\User\UserController;
use AppBundle\Entity\AppUsers;
use AppBundle\Entity\Child;
use AppBundle\Entity\City;
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

class ParentController extends UserController
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
        $formManager = new FormManager();
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
            $user->setCost($formManager->getValueInGrosz($data->get('cost')));
            $user->setSumCost($formManager->getValueInGrosz($data->get('sum_cost')));
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
        $formManager = new FormManager();
        $entityManager = $this->getDoctrine()->getManager();
        $data = $request->request;
        $allData = $data->all();
        $userId = $data->get('userId');

        $user = $this->getDoctrine()
            ->getRepository(UserParent::class)
            ->findOneById($userId);
        $appUser = $this->getDoctrine()
            ->getRepository(AppUsers::class)
            ->findOneById($user->getUser()->getId());

        if (!$user|| !$appUser) {
            throw $this->createNotFoundException(
                'No user found for id '.$userId
            );
        }

        try {
            $appUser->setUsername($data->get('phone'));
            $appUser->setEmail($data->get('email'));
            $appUser->setName($data->get('name'));
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
            $newFileName = $this->uploadFile('parent_contract', 'contract');
            if($newFileName)  $user->setContractFile($newFileName);
            $user->setCost($formManager->getValueInGrosz($data->get('cost')));
            $user->setSumCost($formManager->getValueInGrosz($data->get('sum_cost')));
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
        } catch (Exception $e)
        {
            throw new Exception($e->getMessage());
            return $e->getMessage();
        }


        $schoolId = $data->get('school');
        $school = $this->getDoctrine()
            ->getRepository(School::class)
            ->findOneById($schoolId);

        $em = $this->getDoctrine()->getManager();
        $childs = $em->getRepository(Child::class)
            ->findByParent($userId);

        foreach($childs as $id => $child){
            $childId = $child->getId();
            $child->setName($allData['child_name-'.$childId]);
            $child->setSurname($allData['child_surname-'.$childId]);
            $child->setClassDigit($allData['class_digit-'.$childId]);
            $child->setClassLetter($allData['class_letter-'.$childId]);
            $child->setSchool($school);
            $entityManager->persist($child);
            $entityManager->flush();
        }

        if(!empty($data->get('child_name')))
        {
            $child = new Child();
            $child->setName($data->get('child_name'));
            $child->setSurname($data->get('child_surname'));
            $child->setParent($user);
            $child->setSchool($school);
            $child->setClassDigit($data->get('class_digit'));
            $child->setClassLetter($data->get('class_letter'));
            $entityManager->persist($child);
            $entityManager->flush();
        }
        return new Response();
    }

    public function editProfileAction($userId)
    {
        $formManager = new FormManager();
        $parent = $this->getDoctrine()
            ->getRepository(UserParent::class)
            ->findOneById($userId);
        $user = $this->getDoctrine()
            ->getRepository(AppUsers::class)
            ->findOneById($parent->getUser()->getId());

        $childArr = $this->getDoctrine()
            ->getRepository(Child::class)
            ->findByParent($userId);

        $childList = array();
        $schoolData = array('name' => '', 'id' => '');
        foreach($childArr as $id => $child)
        {
            $schoolData['name'] = $child->getSchool()->getName();
            $schoolData['id'] = $child->getSchool()->getId();
            $childList[] = array(
                'id' => $child->getId(),
                'name' => $child->getName(),
                'surname' => $child->getSurname(),
                'class_digit' => $child->getClassDigit(),
                'class_letter' => $child->getClassLetter(),
            );
        }

        $userArr = array(
            'name' => $user->getName(),
            'surname' => $user->getSurname(),
            'email' => $user->getEmail(),
            'phone' => $user->getPhone(),
            'cost' => $formManager->getValueInZloty($parent->getCost()),
            'sumCost' => $formManager->getValueInZloty($parent->getSumCost()),
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
            'school_name' => $schoolData['name'],
            'school_id' => $schoolData['id'],
        );

        $cities = $this->getCities();

        return $this->render('AdminBundle:User\Parent:edit.html.twig', array(
            'action_url' => 'update_parent',
            'userArr' => $userArr,
            'cities' => $cities,
            'childs' => $childList));
    }

    public function showProfileAction($userId)
    {
        $formManager = new FormManager();
        $parent = $this->getDoctrine()
            ->getRepository(UserParent::class)
            ->findOneById($userId);

        $userArr = array(
            'name' => $parent->getUser()->getName(),
            'surname' => $parent->getUser()->getSurname(),
            'email' => $parent->getUser()->getEmail(),
            'phone' => $parent->getUser()->getPhone(),
            'contract' => $parent->getContractFile(),
            'cost' => $formManager->getValueInZloty($parent->getCost()),
            'sumCost' => $formManager->getValueInZloty($parent->getSumCost()),
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
            ->getRepository(UserParent::class)
            ->createQueryBuilder('u')
            ->select('u')
            ->getQuery()
            ->getResult();

        $rows = array();
        foreach($result as $id => $row)
        {
            $is_active = ($row->getUser()->getIsActive()) ?  'TAK' : 'NIE';
            $rows[] = array(
                'id' => $row->getId(),
                'name' => $row->getUser()->getName(),
                'surname' => $row->getUser()->getSurname(),
                'email' => $row->getUser()->getEmail(),
                'is_active' => $is_active,
                'phone' => $row->getUser()->getPhone(),
            );
        }

        return $this->render('AdminBundle:User\Parent:show.html.twig', array(
            'users' => $rows));
    }

    public function filterAction(Request $request)
    {
        $data = $request->request->all();

        $condition['isActive'] = 'EQUAL';

        $filterManager = new FilterManager($this->getDoctrine());
        $filterManager->setTable(array(
            'fullName' =>'AppBundle\Entity\UserParent',
            'shortName' => 'ul'));
        $filterManager->setJoin(array(
            'ul.user' => 'au'));
        $filterManager->setCondition($data, 'au', $condition);
        $filterManager->setSelect(array('ul'));
        $filteredData = $filterManager->getfilteredData();

        $rows = array();
        foreach($filteredData as $id => $row)
        {
            $is_active = ($row->getUser()->getIsActive()) ?  'TAK' : 'NIE';
            $rows[] = array(
                'id' => $row->getId(),
                'name' => $row->getUser()->getName(),
                'surname' => $row->getUser()->getSurname(),
                'email' => $row->getUser()->getEmail(),
                'is_active' => $is_active,
                'phone' => $row->getUser()->getPhone(),
            );
        }
        $jsonData = json_encode($rows);

        return new Response($jsonData);
    }
}
