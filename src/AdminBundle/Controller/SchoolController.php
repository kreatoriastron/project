<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\AppUsers;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\School;
use AppBundle\Service\FormManager\FormManager;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Service\DBManager\FilterManager;

class SchoolController extends Controller
{
    public function addAction(Request $request)
    {
        $name = $request->request->get('name');

        if ($name)
        {
            $schoolId = $this->save($request->request);
            return $this->render('AdminBundle:School:success.html.twig', array(
                'schoolId' => $schoolId));
        }
        return $this->render('AdminBundle:School:add.html.twig', array(
            'action_url' => 'add_school'));
    }

    private function save($data)
    {
        $entityManager = $this->getDoctrine()->getManager();

        try {
            $school = new School();
            $school->setName($data->get('name'));
            $school->setSurname($data->get('surname'));
            $school->setSchool($data->get('school'));
            $school->setClassDigit($data->get('class_digit'));
            $school->setClassLetter($data->get('class_letter'));
            $school->setPhone($data->get('phone'));
            $school->setMail($data->get('mail'));
            $school->setChildName($data->get('child_name'));
            $school->setChildSurname($data->get('child_surname'));
            $entityManager->persist($school);
            $entityManager->flush();
            $newSchoolId = $school->getId();
        } catch (Exception $e)
        {
            throw new Exception($e->getMessage());
            return $e->getMessage();
        }

        return $newSchoolId;
    }

    public function updateAction(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $data = $request->request;
        $schoolId = $data->get('schoolId');

        $school = $this->getDoctrine()
            ->getRepository(School::class)
            ->findOneById($schoolId);

        if (!$school) {
            throw $this->createNotFoundException(
                'No school found for id '.$schoolId
            );
        }

        try {
            $school->setName($data->get('name'));
            $school->setSurname($data->get('surname'));
            $school->setSchool($data->get('school'));
            $school->setClassDigit($data->get('class_digit'));
            $school->setClassLetter($data->get('class_letter'));
            $school->setPhone($data->get('phone'));
            $school->setMail($data->get('mail'));
            $school->setChildName($data->get('child_name'));
            $school->setChildSurname($data->get('child_surname'));
            $entityManager->persist($school);
            $entityManager->flush();
        } catch (Exception $e)
        {
            throw new Exception($e->getMessage());
            return $e->getMessage();
        }

        return new Response();
    }

    public function editSchoolAction($schoolId)
    {
        $school = $this->getDoctrine()
            ->getRepository(School::class)
            ->findById($schoolId);

        $schoolArr = array(
            'name' => $school[0]->getName(),
            'surname' => $school[0]->getSurname(),
            'email' => $school[0]->getEmail(),
            'phone' => $school[0]->getPhone(),
            'child_name' => $school[0]->getChildName(),
            'child_surname' => $school[0]->getChildSurname(),
            'school' => $school[0]->getSchool(),
            'class_digit' => $school[0]->getClassDigit(),
            'class_letter' => $school[0]->getClassLetter(),
            'id' => $school[0]->getId(),
        );

        return $this->render('AdminBundle:School:edit.html.twig', array(
            'action_url' => 'update_school',
            'schoolArr' => $schoolArr));
    }

    public function showSchoolAction($schoolId)
    {
        $school = $this->getDoctrine()
            ->getRepository(School::class)
            ->findById($schoolId);

        $schoolArr = array(
            'name' => $school[0]->getName(),
            'surname' => $school[0]->getSurname(),
            'email' => $school[0]->getEmail(),
            'phone' => $school[0]->getPhone(),
            'child_name' => $school[0]->getChildName(),
            'child_surname' => $school[0]->getChildSurname(),
            'school' => $school[0]->getSchool(),
            'class_digit' => $school[0]->getClassDigit(),
            'class_letter' => $school[0]->getClassLetter(),
            'id' => $school[0]->getId(),
        );

        return $this->render('AdminBundle:School:showSchool.html.twig', array(
            'schoolArr' => $schoolArr));
    }

    public function showAction()
    {
        $result = $this->getDoctrine()
            ->getRepository(School::class)
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
                'school' => $row->getSchool(),
                'class_digit' => $row->getClassDigit(),
                'class_letter' => $row->getClassLetter(),
                'child_name' => $row->getChildName(),
                'child_surname' => $row->getChildSurname()
            );
        }

        return $this->render('AdminBundle:School:show.html.twig', array(
            'schools' => $rows,
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
                $data['school.'.$key] = $value;
            }
        }
        var_dump($data);
        $school = $this->getDoctrine()
            ->getRepository(School::class)
            ->findBy($data);exit();
        var_dump($school); exit();
        $filterManager = new FilterManager($this->getDoctrine());
        $repository = $this->doctrine
            ->getRepository($table);

        $query = $repository->createQueryBuilder('u');
        $query->leftJoin(AppUsers::class, "au", "WITH", "u.school=au.id");
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


        $date = $filterManager->findByFilteredData(School::class, $data);

        $products = $this->getDoctrine()
            ->getRepository(School::class)
            ->findByFilteredData($data);
    }

    public function importAction(Request $request)
    {
        $file = $request->request->get('file-upload');

        if ($file)
        {
            $schoolId = $this->save($request->request);
            return $this->render('AdminBundle:School:success.html.twig', array(
                'schoolId' => $schoolId));
        }
        return $this->render('AdminBundle:School:import.html.twig', array(
            'action_url' => 'add_school'));
    }

    public function assignDRAction(Request $request)
    {
        $file = $request->request->get('file-upload');

        if ($file)
        {
            $schoolId = $this->save($request->request);
            return $this->render('AdminBundle:School:success.html.twig', array(
                'schoolId' => $schoolId));
        }
        return $this->render('AdminBundle:School:assignDR.html.twig', array(
            'action_url' => 'add_school'));
    }
}
