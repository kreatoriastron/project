<?php

namespace AdminBundle\Controller;

use AdminBundle\Controller\User\UserController;
use AppBundle\Entity\City;
use AppBundle\Entity\ImportFile;
use AppBundle\Entity\UserDr;
use AppBundle\Entity\Wojewodztwo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\AppUsers;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\School;
use AppBundle\Entity\SchoolToDr;
use AppBundle\Service\FormManager\FormManager;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Service\DBManager\FilterManager;

class SchoolController extends UserController
{
    const LIMIT_PER_PAGE = 100;

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
            $school->setNameOwn($data->get('name_own'));
            $school->setSurname($data->get('surname'));
            $school->setSchool($data->get('school'));
            $school->setClassDigit($data->get('class_digit'));
            $school->setClassLetter($data->get('class_letter'));
            $school->setPhone($data->get('phone'));
            $school->setMail($data->get('mail'));
            $school->setChildName($data->get('child_name'));
            $school->setChildSurname($data->get('child_surname'));
            $school->setStd(null);
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

        $std = $this->getDoctrine()
            ->getRepository(SchoolToDr::class)
            ->findOneBySchool($schoolId);

        $userDr = $this->getDoctrine()
            ->getRepository(UserDr::class)
            ->findOneById($data->get('dr'));

        if (!$std || !$userDr) {
            throw $this->createNotFoundException(
                'No school found for id '.$schoolId
            );
        }

        try {
            $std->getSchool()->setName($data->get('name'));
            $std->getSchool()->setNameOwn($data->get('name_own'));
            $std->getSchool()->setPhone($data->get('phone'));
            $std->getSchool()->setWWW($data->get('www'));
            $std->getSchool()->setStudentCount($data->get('student_count'));
            $std->getSchool()->setClassCount($data->get('class_count'));
            $std->setUserDr($userDr);
            $entityManager->persist($std);
            $entityManager->flush();
        } catch (Exception $e)
        {
            throw new Exception($e->getMessage());
            return $e->getMessage();
        }

        return new Response('correct');
    }

    public function editSchoolAction($schoolId = 0)
    {
        $std = $this->getDoctrine()
            ->getRepository(SchoolToDr::class)
            ->findOneBySchool($schoolId);

        $schoolArr = array(
            'id' => $std->getSchool()->getId(),
            'wojewodztwo' => $std->getSchool()->getWojewodztwo()->getName(),
            'powiat' => $std->getSchool()->getPowiat(),
            'gmina' => $std->getSchool()->getGmina(),
            'city' => $std->getSchool()->getCity(),
            'name' => $std->getSchool()->getName(),
            'name_own' => $std->getSchool()->getNameOwn(),
            'address' => $std->getSchool()->getAddress(),
            'zipcode' => $std->getSchool()->getZipcode(),
            'post' => $std->getSchool()->getPost(),
            'phone' => $std->getSchool()->getPhone(),
            'www' => $std->getSchool()->getWww(),
            'publicznosc' => $std->getSchool()->getPublicznosc(),
            'student_count' => $std->getSchool()->getStudentCount(),
            'class_count' => $std->getSchool()->getClassCount(),
            'dr_id' => $std->getUserDr()->getId()
        );

        $drArr = $this->getDr();

        return $this->render('AdminBundle:School:edit.html.twig', array(
            'action_url' => 'update_school',
            'schoolArr' => $schoolArr,
            'drList' => $drArr));
    }

    public function showSchoolAction($schoolId)
    {
        $school = $this->getDoctrine()
            ->getRepository(School::class)
            ->findById($schoolId);

        $schoolArr = array(
            'name' => $school[0]->getName(),
            'name_own' => $school[0]->getNameOwn(),
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
            ->createQueryBuilder('s')
            ->select('s')
            ->where('s.type=:type')
            ->setParameter('type','00003')
            ->setMaxResults(SchoolController::LIMIT_PER_PAGE)
            ->getQuery()
            ->getResult();

        $rows = array();
        $columns = array(
            'Id',
            'Województwo',
            'Powiat',
            'Gmina',
            'Miasto',
            'Nazwa',
            'Adres',
            'Kod pocztowy',
            'Poczta',
            'Telefon',
            'WWW',
            'Publiczność',
            'Liczba uczniów',
            'Liczba klas'
        );
        foreach($result as $id => $row)
        {
            $schoolToDr = $this->getDoctrine()
                ->getRepository(SchoolToDr::class)
                ->findOneBySchool($row);
            if($schoolToDr) {
                $dr = $schoolToDr->getUserDr()->getUser()->getName() . ' ' . $schoolToDr->getUserDr()->getUser()->getSurname();
            } else {
                $dr = '';
            }

            $rows[] = array(
                'id' => $row->getId(),
                'wojewodztwo' => $row->getWojewodztwo()->getName(),
                'powiat' => $row->getPowiat(),
                'gmina' => $row->getGmina(),
                'city' => $row->getCity(),
                'name' => $row->getName(),
                'name_own' => $row->getNameOwn(),
                'address' => $row->getAddress(),
                'zipcode' => $row->getZipcode(),
                'post' => $row->getPost(),
                'phone' => $row->getPhone(),
                'www' => $row->getWww(),
                'publicznosc' => $row->getPublicznosc(),
                'student_count' => $row->getStudentCount(),
                'class_count' => $row->getClassCount(),
                'dr' => $dr
            );
        }

        $wojewodztwaArr = $this->getWojewodztwa();
        $drArr = $this->getDr();

        return $this->render('AdminBundle:School:show.html.twig', array(
            'schools' => $rows,
            'columns' => $columns,
            'wojewodztwa' => $wojewodztwaArr,
            'drList' => $drArr));
    }

    private function getWojewodztwa()
    {
        $wojewodztwa = $this->getDoctrine()
            ->getRepository(Wojewodztwo::class)
            ->createQueryBuilder('w')
            ->select('w')
            ->getQuery()
            ->getResult();
        $wojewodztwaArr = array();
        foreach($wojewodztwa as $id => $wojewodztwo)
        {
            $wojewodztwaArr[] = array(
                'id' => $wojewodztwo->getId(),
                'name' => $wojewodztwo->getName()
            );
        }

        return $wojewodztwaArr;
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
        // only elementary school
        unset($data['dr']);
        $data['type'] = '00003';
        $dataUser['name_or_first'] = $request->request->get('dr');
        $dataUser['surname_or_first'] = $request->request->get('dr');

        $conditionTypeUser['name_or_first'] = 'OR';
        $conditionTypeUser['surname_or_first'] = 'OR';

        $conditionType['wojewodztwo'] = 'EQUAL';
        $conditionType['studentCount_from'] = 'GREATER';
        $conditionType['studentCount_to'] = 'LESS';
        $conditionType['classCount_from'] = 'GREATER';
        $conditionType['classCount_to'] = 'LESS';

        $filterManager = new FilterManager($this->getDoctrine());
        $filterManager->setTable(array(
            'fullName' =>'AppBundle\Entity\School',
            'shortName' => 'school'));
        $filterManager->setJoin(array(
            'school.std' => 'std'));
        $filterManager->setJoin(array(
            'std.userDr' => 'ud'));
        $filterManager->setJoin(array(
            'ud.user' => 'u'));
        $filterManager->setCondition($data, 'school', $conditionType);
        $filterManager->setCondition($dataUser, 'u', $conditionTypeUser);
        $filterManager->setSelect(array('school, std, ud, u'));
        $filterManager->setLimit(SchoolController::LIMIT_PER_PAGE);
        $filteredData = $filterManager->getfilteredData();
        $rows = array();
        foreach($filteredData as $id => $row)
        {
            if(is_object($row->getStd())) {
                $name = $row->getStd()->getUserDr()->getUser()->getName() . ' ' . $row->getStd()->getUserDr()->getUser()->getSurname();
            } else {
                $name = '';
            }
            $rows[] = array(
                'id' => $row->getId(),
                'wojewodztwo' => $row->getWojewodztwo()->getName(),
                'powiat' => $row->getPowiat(),
                'gmina' => $row->getGmina(),
                'city' => $row->getCity(),
                'name' => $row->getName(),
                'name_own' => $row->getNameOwn(),
                'address' => $row->getAddress(),
                'zipcode' => $row->getZipcode(),
                'post' => $row->getPost(),
                'phone' => $row->getPhone(),
                'www' => $row->getWww(),
                'publicznosc' => $row->getPublicznosc(),
                'student_count' => $row->getStudentCount(),
                'class_count' => $row->getClassCount(),
                'dr' => $name
            );
        }
        $jsonData = json_encode($rows);

        return new Response($jsonData);
    }

    public function assignDRAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $schools = $request->request->get('id');
        $dr = $request->request->get('dr');

        if(is_null($schools) || is_null($dr))
        {
            return new Response('error');
        }

        try {
            $userDr = $em->getRepository(UserDr::class)->findOneById($dr);

            foreach($schools as $id => $schoolId) {
                $school = $em->getRepository(School::class)->findOneById($schoolId);
                $schoolToDr = $em->getRepository(SchoolToDr::class)->findOneBySchool($schoolId);

                if ($schoolToDr === null) {
                    $schoolToDr = new SchoolToDr();
                }

                $schoolToDr->setSchool($school);
                $schoolToDr->setUserDr($userDr);
                $em->persist($schoolToDr);
                $school->setStd($schoolToDr);
            }
            $em->flush();
        }catch(Exception $e) {
            return new Response($e->getMessage());
        }

        return new Response('correct');
    }

    public function importAction(Request $request)
    {
        $file = $this->uploadFile('school', 'school_file', array('document'));

        if ($file)
        {
            $entityManager = $this->getDoctrine()->getManager();

            try {
                $import = new ImportFile();
                $import->setDir('school');
                $import->setFilename($file);
                $import->setInProgress(0);
                $import->setType(1);
                $entityManager->persist($import);
                $entityManager->flush();

                return new Response('correct');
            } catch (Exception $e)
            {
                throw new Exception($e->getMessage());
                return $e->getMessage();
            }
        }
        return $this->render('AdminBundle:School:import.html.twig', array(
            'action_url' => 'add_group'));
    }

    public function getByCityAction(Request $request)
    {
        $cityId = $request->request->get('city');

        $cityObj = $this->getDoctrine()
            ->getRepository(City::class)
            ->createQueryBuilder('c')
            ->select('c')
            ->where('c.id=:id')
            ->setParameter('id', $cityId)
            ->getQuery()
            ->getResult();

        $request->request->set('wojewodztwo' , $cityObj[0]->getWojewodztwo()->getId());
        $request->request->set('powiat' , $cityObj[0]->getPowiat());
        $request->request->set('gmina' , $cityObj[0]->getGmina());
        $request->request->set('city' , $cityObj[0]->getCity());
        $request->request->set('type' , '00003');

        return  $this->forward('AdminBundle:School:filter');

    }
}
