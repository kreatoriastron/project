<?php

namespace AdminBundle\Controller\User;

use AdminBundle\Controller\User\UserController;
use AppBundle\Entity\AppUsers;
use AppBundle\Entity\Child;
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
        return $this->render('AdminBundle:User\Parent:add.html.twig', array(
                'action_url' => 'add_parent'));
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
            $appUser->setRole(1);
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

            $user = new UserParent();
            $user->setUser($appUser);
            $newFileName = $this->uploadFile('parent_contract', 'contract');
            $user->setContractFile($newFileName);
            $entityManager->persist($user);
            $entityManager->flush();
            $newParentId = $user->getId();
        } catch (Exception $e)
        {
            throw new Exception($e->getMessage());
            return $e->getMessage();
        }

        try {
            $time = strtotime($data->get('ending_date'));

            $child = new Child();
            $child->setName($data->get('name'));
            $child->setSurname($data->get('surname'));
            $child->setParentId($newParentId);
            $child->setSchoolId($data->get('school'));
            $child->setClassDigit($data->get('class_digit'));
            $child->setClassLetter($data->get('class_letter'));
            $entityManager->persist($child);
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
            ->getRepository(UserParent::class)
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
            $newFileName = $this->uploadFile('parent_contract', 'contract');
            $user->setContractFile($newFileName);
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
        $parent = $this->getDoctrine()
            ->getRepository(UserParent::class)
            ->findByUser($userId);
        $user = $this->getDoctrine()
            ->getRepository(AppUsers::class)
            ->findById($userId);

        $userArr = array(
            'name' => $user[0]->getName(),
            'surname' => $user[0]->getSurname(),
            'email' => $user[0]->getEmail(),
            'phone' => $user[0]->getPhone(),
            'contract' => $parent[0]->getContractFile(),
            'id' => $user[0]->getId(),
        );

        return $this->render('AdminBundle:User\Parent:edit.html.twig', array(
            'action_url' => 'update_parent',
            'userArr' => $userArr));
    }

    public function showProfileAction($userId)
    {
        $parent = $this->getDoctrine()
            ->getRepository(UserParent::class)
            ->findByUser($userId);
        $user = $this->getDoctrine()
            ->getRepository(AppUsers::class)
            ->findById($userId);

        $userArr = array(
            'name' => $user[0]->getName(),
            'surname' => $user[0]->getSurname(),
            'email' => $user[0]->getEmail(),
            'phone' => $user[0]->getPhone(),
            'contract' => $parent[0]->getContractFile(),
            'id' => $user[0]->getId(),
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

        return $this->render('AdminBundle:User\Parent:show.html.twig', array(
            'users' => $rows,
            'columns' => $columns));
    }

    public function filterAction(Request $request)
    {
        $data['au.name'] = $request->request->get('name');
        $data['au.surname'] = $request->request->get('surname');
        $data['au.email'] = $request->request->get('email');
        $data['au.phone'] = $request->request->get('phone');
        $data['au.isActive'] = $request->request->get('is_active');

        $filterManager = new FilterManager($this->getDoctrine());
        $filterManager->setTable(array(
            'fullName' =>'AppBundle\Entity\UserParent',
            'shortName' => 'ul'));
        $filterManager->setJoin(array(
            'ul.user' => 'au'));
        $filterManager->setCondition($data);
        $filterManager->setSelect(array('ul'));
        $filteredData = $filterManager->getfilteredData();

        $rows = array();
        foreach($filteredData as $id => $row)
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
        $jsonData = json_encode($rows);

        return new Response($jsonData);
    }
}
