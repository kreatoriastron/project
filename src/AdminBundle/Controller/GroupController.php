<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\AppUsers;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Group;
use AppBundle\Service\FormManager\FormManager;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Service\DBManager\FilterManager;

class GroupController extends Controller
{
    public function addAction(Request $request)
    {
        $name = $request->request->get('name');

        if ($name)
        {
            $groupId = $this->save($request->request);
            return $this->render('AdminBundle:Group:success.html.twig', array(
                'groupId' => $groupId));
        }
        return $this->render('AdminBundle:Group:add.html.twig', array(
            'action_url' => 'add_group'));
    }

    private function save($data)
    {
        $entityManager = $this->getDoctrine()->getManager();

        try {
            $group = new Group();
            $group->setName($data->get('name'));
            $group->setSurname($data->get('surname'));
            $group->setGroup($data->get('group'));
            $group->setClassDigit($data->get('class_digit'));
            $group->setClassLetter($data->get('class_letter'));
            $group->setPhone($data->get('phone'));
            $group->setMail($data->get('mail'));
            $group->setChildName($data->get('child_name'));
            $group->setChildSurname($data->get('child_surname'));
            $entityManager->persist($group);
            $entityManager->flush();
            $newGroupId = $group->getId();
        } catch (Exception $e)
        {
            throw new Exception($e->getMessage());
            return $e->getMessage();
        }

        return $newGroupId;
    }

    public function updateAction(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $data = $request->request;
        $groupId = $data->get('groupId');

        $group = $this->getDoctrine()
            ->getRepository(Group::class)
            ->findOneById($groupId);

        if (!$group) {
            throw $this->createNotFoundException(
                'No group found for id '.$groupId
            );
        }

        try {
            $group->setName($data->get('name'));
            $group->setSurname($data->get('surname'));
            $group->setGroup($data->get('group'));
            $group->setClassDigit($data->get('class_digit'));
            $group->setClassLetter($data->get('class_letter'));
            $group->setPhone($data->get('phone'));
            $group->setMail($data->get('mail'));
            $group->setChildName($data->get('child_name'));
            $group->setChildSurname($data->get('child_surname'));
            $entityManager->persist($group);
            $entityManager->flush();
        } catch (Exception $e)
        {
            throw new Exception($e->getMessage());
            return $e->getMessage();
        }

        return new Response();
    }

    public function editGroupAction($groupId)
    {
        $group = $this->getDoctrine()
            ->getRepository(Group::class)
            ->findById($groupId);

        $groupArr = array(
            'name' => $group[0]->getName(),
            'surname' => $group[0]->getSurname(),
            'email' => $group[0]->getEmail(),
            'phone' => $group[0]->getPhone(),
            'child_name' => $group[0]->getChildName(),
            'child_surname' => $group[0]->getChildSurname(),
            'group' => $group[0]->getGroup(),
            'class_digit' => $group[0]->getClassDigit(),
            'class_letter' => $group[0]->getClassLetter(),
            'id' => $group[0]->getId(),
        );

        return $this->render('AdminBundle:Group:edit.html.twig', array(
            'action_url' => 'update_group',
            'groupArr' => $groupArr));
    }

    public function showGroupAction($groupId)
    {
        $group = $this->getDoctrine()
            ->getRepository(Group::class)
            ->findById($groupId);

        $groupArr = array(
            'name' => $group[0]->getName(),
            'surname' => $group[0]->getSurname(),
            'email' => $group[0]->getEmail(),
            'phone' => $group[0]->getPhone(),
            'child_name' => $group[0]->getChildName(),
            'child_surname' => $group[0]->getChildSurname(),
            'group' => $group[0]->getGroup(),
            'class_digit' => $group[0]->getClassDigit(),
            'class_letter' => $group[0]->getClassLetter(),
            'id' => $group[0]->getId(),
        );

        return $this->render('AdminBundle:Group:showGroup.html.twig', array(
            'groupArr' => $groupArr));
    }

    public function showAction()
    {
        $result = $this->getDoctrine()
            ->getRepository(Group::class)
            ->createQueryBuilder('f')
            ->select('f')
            ->getQuery()
            ->getResult();

        $rows = array();
        $columns = array(
            'Imię rodzica',
            'Nazwisko rodzica',
            'Email',
            'Telefon',
            'Szkoła',
            'Klasa cyfra',
            'Klasa litera',
            'Imię dziecka',
            'Nazwisko Dziecka'
        );
        foreach($result as $id => $row)
        {
            $rows[] = array(
                'id' => $row->getId(),
                'name' => $row->getName(),
                'surname' => $row->getSurname(),
                'email' => $row->getEmail(),
                'phone' => $row->getPhone(),
                'group' => $row->getGroup(),
                'class_digit' => $row->getClassDigit(),
                'class_letter' => $row->getClassLetter(),
                'child_name' => $row->getChildName(),
                'child_surname' => $row->getChildSurname()
            );
        }

        return $this->render('AdminBundle:Group:show.html.twig', array(
            'groups' => $rows,
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
                $data['group.'.$key] = $value;
            }
        }
        var_dump($data);
        $group = $this->getDoctrine()
            ->getRepository(Group::class)
            ->findBy($data);exit();
        var_dump($group); exit();
        $filterManager = new FilterManager($this->getDoctrine());
        $repository = $this->doctrine
            ->getRepository($table);

        $query = $repository->createQueryBuilder('u');
        $query->leftJoin(AppUsers::class, "au", "WITH", "u.group=au.id");
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


        $date = $filterManager->findByFilteredData(Group::class, $data);

        $products = $this->getDoctrine()
            ->getRepository(Group::class)
            ->findByFilteredData($data);
    }

    public function importAction(Request $request)
    {
        $file = $request->request->get('file-upload');

        if ($file)
        {
            $groupId = $this->save($request->request);
            return $this->render('AdminBundle:Group:success.html.twig', array(
                'groupId' => $groupId));
        }
        return $this->render('AdminBundle:Group:import.html.twig', array(
            'action_url' => 'add_group'));
    }

    public function assignLectorAction(Request $request)
    {
        $file = $request->request->get('file-upload');

        if ($file)
        {
            $groupId = $this->save($request->request);
            return $this->render('AdminBundle:Group:success.html.twig', array(
                'groupId' => $groupId));
        }
        return $this->render('AdminBundle:Group:assignLector.html.twig', array(
            'action_url' => 'add_group'));
    }
}
