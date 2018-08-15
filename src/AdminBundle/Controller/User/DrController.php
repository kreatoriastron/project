<?php

namespace AdminBundle\Controller\User;

use AdminBundle\Controller\User\UserController;
use AppBundle\Entity\AppUsers;
use AppBundle\Entity\Messanger;
use FOS\UserBundle\Model\User;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\UserDr;
use AppBundle\Service\FormManager\FormManager;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Service\DBManager\FilterManager;

class DrController extends UserController
{
    public function addAction(Request $request)
    {
        $name = $request->request->get('name');

        if ($name)
        {
            $userId = $this->save($request->request);
            return $this->render('AdminBundle:User\Dr:success.html.twig', array(
                'userId' => $userId));
        }
        return $this->render('AdminBundle:User\Dr:add.html.twig', array(
                'action_url' => 'add_dr'));
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
            $appUser->setRole(3);
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
            $user = new UserDr();
            $user->setUser($appUser);
            $user->setEmployeeType($data->get('employee_type'));
            $user->setContractEndingDate($time);
            $newFileName = $this->uploadFile('contract', 'contract');
            $user->setContract($newFileName);
            $user->setBankNumber($data->get('bank_number'));
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

        $user = $this->getDoctrine()
            ->getRepository(UserDr::class)
            ->findOneByUser($userId);
        $appUser = $this->getDoctrine()
            ->getRepository(AppUsers::class)
            ->findOneById($userId);

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
            $time = strtotime($data->get('ending_date'));
            $user->setEmployeeType($data->get('employee_type'));
            $user->setContractEndingDate($time);
            $newFileName = $this->uploadFile('contract', 'contract');
            if($newFileName != 0) $user->setContract($newFileName);
            $user->setBankNumber($data->get('bank_number'));
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

        return new Response();
    }

    public function editProfileAction($userId)
    {
        $dr = $this->getDoctrine()
            ->getRepository(UserDr::class)
            ->findOneById($userId);
        if (!$dr) {
            throw $this->createNotFoundException(
                'No user found'
            );
        }
        $user = $this->getDoctrine()
            ->getRepository(AppUsers::class)
            ->findOneById($dr->getUser());


        $timestamp = $dr->getContractEndingDate();
        $formManager = new FormManager();
        $date = $formManager->timestampToDate($timestamp);
        $userArr = array(
            'name' => $user->getName(),
            'surname' => $user->getSurname(),
            'email' => $user->getEmail(),
            'phone' => $user->getPhone(),
            'type' => $dr->getEmployeeType(),
            'endDate' => $date,
            'contract' => $dr->getContract(),
            'id' => $user->getId(),
            'bank_number' => $dr->getBankNumber(),
            'ra_city' => $dr->getRaCity(),
            'ra_zip_code' => $dr->getRaZipCode(),
            'ra_street' => $dr->getRaStreet(),
            'ra_building' => $dr->getRaBuilding(),
            'ra_apartment' => $dr->getRaApartment(),
            'ca_city' => $dr->getCaCity(),
            'ca_zip_code' => $dr->getCaZipCode(),
            'ca_street' => $dr->getCaStreet(),
            'ca_building' => $dr->getCaBuilding(),
            'ca_apartment' => $dr->getCaApartment(),
        );

        return $this->render('AdminBundle:User\Dr:edit.html.twig', array(
            'action_url' => 'update_dr',
            'userArr' => $userArr));
    }

    public function showProfileAction($userId)
    {
        $dr = $this->getDoctrine()
            ->getRepository(UserDr::class)
            ->findOneById($userId);

        $timestamp = $dr->getContractEndingDate();
        $formManager = new FormManager();
        $date = $formManager->timestampToDate($timestamp);
        $userArr = array(
            'name' => $dr->getUser()->getName(),
            'surname' => $dr->getUser()->getSurname(),
            'email' => $dr->getUser()->getEmail(),
            'phone' => $dr->getUser()->getPhone(),
            'endDate' => $date,
            'contract' => $dr->getContract(),
            'id' => $dr->getId(),
            'type' => $dr->getEmployeeType(),
            'bank_number' => $dr->getBankNumber(),
            'ra_city' => $dr->getRaCity(),
            'ra_zip_code' => $dr->getRaZipCode(),
            'ra_street' => $dr->getRaStreet(),
            'ra_building' => $dr->getRaBuilding(),
            'ra_apartment' => $dr->getRaApartment(),
            'ca_city' => $dr->getCaCity(),
            'ca_zip_code' => $dr->getCaZipCode(),
            'ca_street' => $dr->getCaStreet(),
            'ca_building' => $dr->getCaBuilding(),
            'ca_apartment' => $dr->getCaApartment(),
        );

        return $this->render('AdminBundle:User\Dr:showProfile.html.twig', array(
            'userArr' => $userArr));
    }

    public function showAction()
    {
        $result = $this->getDoctrine()
            ->getRepository(UserDr::class)
            ->createQueryBuilder('u')
            ->select('u')
            ->getQuery()
            ->getResult();

        $rows = array();
        $columns = array(
            'Imię',
            'Nazwisko',
            'Email',
            'Telefon',
            'Aktywny'
        );
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

        return $this->render('AdminBundle:User\Dr:show.html.twig', array(
            'users' => $rows,
            'columns' => $columns));
    }

    public function filterAction(Request $request)
    {
        $data = $request->request->all();

        $condition['isActive'] = 'EQUAL';
        $filterManager = new FilterManager($this->getDoctrine());
        $filterManager->setTable(array(
            'fullName' =>'AppBundle\Entity\UserDr',
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
