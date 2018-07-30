<?php

namespace AdminBundle\Controller\User;

use AdminBundle\Controller\User\UserController;
use AppBundle\Entity\AppUsers;
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
        return $this->render('AdminBundle:User\Lector:add.html.twig', array(
                'action_url' => 'add_lector'));
    }

    private function save($data)
    {
        $entityManager = $this->getDoctrine()->getManager();

        try {
            $pass = password_hash('ThePassword', PASSWORD_BCRYPT);

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
            $user->setSalary($data->get('salary'));
            $user->setContract($data->get('contract'));
            $user->setBonus($data->get('bonus'));
            $user->setEmployeeType($data->get('employee_type'));
            $user->setLanguageLevel($data->get('language_level'));
            $user->setContractEndingDate($time);
            $newFileName = $this->uploadFile('contract', 'contract');
            $user->setContract($newFileName);
            $entityManager->persist($user);
            $entityManager->flush();
            $newUserId = $user->getId();
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
            $user->setSalary($data->get('salary'));
            $user->setBonus($data->get('bonus'));
            $user->setEmployeeType($data->get('employee_type'));
            $user->setLanguageLevel($data->get('language_level'));
            $user->setContractEndingDate($time);
            $newFileName = $this->uploadFile('contract', 'contract');
            if(strlen($newFileName) > 1) $user->setContract($newFileName);
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
            'salary' => $lector->getSalary(),
            'type' => $lector->getEmployeeType(),
            'lanLevel' => $lector->getLanguageLevel(),
            'endDate' => $date,
            'contract' => $lector->getContract(),
            'bonus' => $lector->getBonus(),
            'id' => $lector->getId(),
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
        $user = $this->getDoctrine()
            ->getRepository(AppUsers::class)
            ->findOneById($lector->getId());

        $timestamp = $lector->getContractEndingDate();
        $formManager = new FormManager();
        $date = $formManager->timestampToDate($timestamp);
        $userArr = array(
            'name' => $user->getName(),
            'surname' => $user->getSurname(),
            'email' => $user->getEmail(),
            'phone' => $user->getPhone(),
            'salary' => $lector->getSalary(),
            'type' => $lector->getEmployeeType(),
            'lanLevel' => $lector->getLanguageLevel(),
            'endDate' => $date,
            'contract' => $lector->getContract(),
            'id' => $user->getId(),
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
            }
            $em->flush();
        }catch(Exception $e) {
            return new Response($e->getMessage());
        }

        return new Response('correct');
    }
}
