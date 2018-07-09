<?php

namespace AdminBundle\Controller\User;

use AdminBundle\Controller\User\UserController;
use AppBundle\Entity\AppUsers;
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
            $pass = password_hash('ThePassword', PASSWORD_BCRYPT);

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
            $newUserId = $appUser->getId();
        } catch (Exception $e)
        {
            throw new Exception($e->getMessage());
            return $e->getMessage();
        }

        try {
            $time = strtotime($data->get('ending_date'));

            $user = new UserDr();
            $user->setUser($appUser);
            $user->setAgreementType($data->get('aggrement_type'));
            $user->setContractEndingDate($time);
            $newFileName = $this->uploadFile('contract', 'contract');
            $user->setContract($newFileName);
            $entityManager->persist($user);
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
            $user->setContract($data->get('contract'));
            $user->setEmployeeType($data->get('employee_type'));
            $user->setContractEndingDate($time);
            $newFileName = $this->uploadFile('contract', 'contract');
            $user->setContract($newFileName);
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
            ->findByUser($userId);
        $user = $this->getDoctrine()
            ->getRepository(AppUsers::class)
            ->findById($userId);

        $timestamp = $dr[0]->getContractEndingDate();
        $formManager = new FormManager();
        $date = $formManager->timestampToDate($timestamp);
        $userArr = array(
            'name' => $user[0]->getName(),
            'surname' => $user[0]->getSurname(),
            'email' => $user[0]->getEmail(),
            'phone' => $user[0]->getPhone(),
            'type' => $dr[0]->getEmployeeType(),
            'endDate' => $date,
            'contract' => $dr[0]->getContract(),
            'id' => $user[0]->getId(),
        );

        return $this->render('AdminBundle:User\Dr:edit.html.twig', array(
            'action_url' => 'update_dr',
            'userArr' => $userArr));
    }

    public function showProfileAction($userId)
    {
        $dr = $this->getDoctrine()
            ->getRepository(UserDr::class)
            ->findByUser($userId);
        $user = $this->getDoctrine()
            ->getRepository(AppUsers::class)
            ->findById($userId);

        $timestamp = $dr[0]->getContractEndingDate();
        $formManager = new FormManager();
        $date = $formManager->timestampToDate($timestamp);
        $userArr = array(
            'name' => $user[0]->getName(),
            'surname' => $user[0]->getSurname(),
            'email' => $user[0]->getEmail(),
            'phone' => $user[0]->getPhone(),
            'endDate' => $date,
            'contract' => $dr[0]->getContract(),
            'id' => $user[0]->getId(),
            'type' => $dr[0]->getEmployeeType(),
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
                'id' => $row->getUser()->getId(),
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
        $data = array();
        $keys = $request->request->keys();

        foreach($keys as $id => $key)
        {
            $value = $request->request->get($key);
            if(!is_null($value) && strlen($value)) {
                $data['user.'.$key] = $value;
            }
        }
        var_dump($data);
        $user = $this->getDoctrine()
            ->getRepository(UserDr::class)
            ->findBy($data);exit();
        var_dump($user); exit();
        $filterManager = new FilterManager($this->getDoctrine());
        $repository = $this->doctrine
            ->getRepository($table);

        $query = $repository->createQueryBuilder('u');
        $query->leftJoin(AppUsers::class, "au", "WITH", "u.user=au.id");
        $query->select('u, au');
        foreach($data as $column => $value)
        {
            if(!is_null($value) && strlen($value))
                $query->andWhere("$column LIKE :value");
            $query->setParameter('value', '%'.$value.'%');
        }
        $aa = $query->getQuery();
        var_dump($aa->getResult()); exit('dddd');
        return $query->getResult();


        $date = $filterManager->findByFilteredData(UserDr::class, $data);

        $products = $this->getDoctrine()
            ->getRepository(UserDr::class)
            ->findByFilteredData($data);
    }
}
