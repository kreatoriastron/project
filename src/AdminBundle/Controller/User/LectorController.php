<?php

namespace AdminBundle\Controller\User;

use AdminBundle\Controller\User\UserController;
use AppBundle\Entity\AppUsers;
use AppBundle\Entity\Messanger;
use FOS\UserBundle\Model\User;
use AppBundle\Entity\UserDr;
use AppBundle\Entity\UserLector;
use AppBundle\Entity\LectorToDr;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Service\FormManager\FormManager;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Service\DBManager\FilterManager;

class LectorController extends UserController
{
    public function addAction(Request $request)
    {
        $name = $request->request->get('name');

        if ($name)
        {
            $userId = $this->save($request->request);
            return $this->render('AdminBundle:User\Lector:success.html.twig', array(
                'userId' => $userId));
        }
        $drArr = $this->getDr();
        return $this->render('AdminBundle:User\Lector:add.html.twig', array(
                'action_url' => 'add_lector',
                'drList' => $drArr));
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
            $appUser->setRole(2);
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

            $user = new UserLector();
            $user->setUser($appUser);
            $user->setSalary($formManager->getValueInGrosz($data->get('salary')));
            $user->setContract($data->get('contract'));
            $user->setBonus($formManager->getValueInGrosz($data->get('bonus')));
            $user->setEmployeeType($data->get('employee_type'));
            $user->setLanguageLevel($data->get('language_level'));
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

            $userDr = $entityManager->getRepository(UserDr::class)->findOneById($data->get('dr'));
            $lectorToDr = new LectorToDr();
            $lectorToDr->setUserLector($user);
            $lectorToDr->setUserDr($userDr);
            $entityManager->persist($lectorToDr);
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
        $userId = $data->get('userId');

        $user = $this->getDoctrine()
            ->getRepository(UserLector::class)
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
            $time = strtotime($data->get('ending_date'));
            $user->setSalary($formManager->getValueInGrosz($data->get('salary')));
            $user->setBonus($formManager->getValueInGrosz($data->get('bonus')));
            $user->setEmployeeType($data->get('employee_type'));
            $user->setLanguageLevel($data->get('language_level'));
            $user->setContractEndingDate($time);
            $newFileName = $this->uploadFile('contract', 'contract');
            if(strlen($newFileName) > 1) $user->setContract($newFileName);
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
        $formManager = new FormManager();
        $lector = $this->getDoctrine()
            ->getRepository(UserLector::class)
            ->findOneById($userId);

        $user = $this->getDoctrine()
            ->getRepository(AppUsers::class)
            ->findOneById($lector->getUser());

        $timestamp = $lector->getContractEndingDate();
        $formManager = new FormManager();
        $date = $formManager->timestampToDate($timestamp);
        $userArr = array(
            'name' => $user->getName(),
            'surname' => $user->getSurname(),
            'email' => $user->getEmail(),
            'phone' => $user->getPhone(),
            'salary' => $formManager->getValueInZloty($lector->getSalary()),
            'type' => $lector->getEmployeeType(),
            'lanLevel' => $lector->getLanguageLevel(),
            'endDate' => $date,
            'contract' => $lector->getContract(),
            'bonus' => $formManager->getValueInZloty($lector->getBonus()),
            'id' => $lector->getId(),
            'bank_number' => $lector->getBankNumber(),
            'ra_city' => $lector->getRaCity(),
            'ra_zip_code' => $lector->getRaZipCode(),
            'ra_street' => $lector->getRaStreet(),
            'ra_building' => $lector->getRaBuilding(),
            'ra_apartment' => $lector->getRaApartment(),
            'ca_city' => $lector->getCaCity(),
            'ca_zip_code' => $lector->getCaZipCode(),
            'ca_street' => $lector->getCaStreet(),
            'ca_building' => $lector->getCaBuilding(),
            'ca_apartment' => $lector->getCaApartment(),
        );

        return $this->render('AdminBundle:User\Lector:edit.html.twig', array(
            'action_url' => 'update_lector',
            'userArr' => $userArr));
    }

    public function showProfileAction($userId)
    {
        $lector = $this->getDoctrine()
            ->getRepository(UserLector::class)
            ->findOneById($userId);

        $timestamp = $lector->getContractEndingDate();
        $formManager = new FormManager();
        $date = $formManager->timestampToDate($timestamp);
        $userArr = array(
            'name' => $lector->getUser()->getName(),
            'surname' => $lector->getUser()->getSurname(),
            'email' => $lector->getUser()->getEmail(),
            'phone' => $lector->getUser()->getPhone(),
            'salary' => $lector->getSalary(),
            'type' => $lector->getEmployeeType(),
            'lanLevel' => $lector->getLanguageLevel(),
            'endDate' => $date,
            'contract' => $lector->getContract(),
            'bonus' => $lector->getBonus(),
            'bank_number' => $lector->getBankNumber(),
            'ra_city' => $lector->getRaCity(),
            'ra_zip_code' => $lector->getRaZipCode(),
            'ra_street' => $lector->getRaStreet(),
            'ra_building' => $lector->getRaBuilding(),
            'ra_apartment' => $lector->getRaApartment(),
            'ca_city' => $lector->getCaCity(),
            'ca_zip_code' => $lector->getCaZipCode(),
            'ca_street' => $lector->getCaStreet(),
            'ca_building' => $lector->getCaBuilding(),
            'ca_apartment' => $lector->getCaApartment(),
            'id' => $lector->getId(),
        );

        return $this->render('AdminBundle:User\Lector:showProfile.html.twig', array(
            'userArr' => $userArr));
    }

    public function showAction()
    {
        $result = $this->getDoctrine()
            ->getRepository(UserLector::class)
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

        $drArr = $this->getDr();

        return $this->render('AdminBundle:User\Lector:show.html.twig', array(
            'users' => $rows,
            'columns' => $columns,
            'drList' => $drArr));
    }

    private function getDr()
    {
        $drs = $this->getDoctrine()
            ->getRepository(UserDr::class)
            ->createQueryBuilder('dr')
            ->select('dr')
            ->getQuery()
            ->getResult();

        $drArr = array();
        foreach($drs as $id => $dr)
        {
            $drArr[] = array(
                'id' => $dr->getId(),
                'name' => $dr->getUser()->getName(),
                'surname' => $dr->getUser()->getSurname(),
            );
        }

        return $drArr;
    }

    public function filterAction(Request $request)
    {
        $data = $request->request->all();

        $condition['isActive'] = 'EQUAL';
        $filterManager = new FilterManager($this->getDoctrine());
        $filterManager->setTable(array(
                             'fullName' =>'AppBundle\Entity\UserLector',
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

    public function assignDrAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $lectors = $request->request->get('id');
        $dr = $request->request->get('dr');

        if(is_null($lectors) || is_null($dr))
        {
            return new Response('error');
        }

        try {
            $userDr = $em->getRepository(UserDr::class)->findOneById($dr);

            foreach($lectors as $id => $lectorId) {
                $lector = $em->getRepository(UserLector::class)->findOneById($lectorId);
                $lectorToDr = $em->getRepository(LectorToDr::class)->findOneByUserLector($lectorId);

                if ($lectorToDr === null) {
                    $lectorToDr = new LectorToDr();
                }

                $lectorToDr->setUserLector($lector);
                $lectorToDr->setUserDr($userDr);
                $em->persist($lectorToDr);

                $lector->setLtd($lectorToDr);
            }
            $em->flush();
        }catch(Exception $e) {
            return new Response($e->getMessage());
        }

        return new Response('correct');
    }
}
