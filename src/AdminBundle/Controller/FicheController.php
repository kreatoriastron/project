<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\AppUsers;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Fiche;
use AppBundle\Entity\School;
use AppBundle\Service\FormManager\FormManager;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Service\DBManager\FilterManager;

class FicheController extends Controller
{
    public function addAction(Request $request)
    {
        $name = $request->request->get('name');

        if ($name)
        {
            $ficheId = $this->save($request->request);
            if($ficheId) {
                return $this->render('AdminBundle:Fiche:success.html.twig', array(
                    'ficheId' => $ficheId));
            } else {
                $response = json_encode(
                    array(
                        'type' => 'error',
                        'title' =>'Wystąpił błąd',
                        'content' => 'Nie znaleziono takiej szkoły'
                    ));
                return new Response($response);
            }
        }
        return $this->render('AdminBundle:Fiche:add.html.twig', array(
            'action_url' => 'add_fiche'));
    }

    private function save($data)
    {
        $school = $this->getDoctrine()
            ->getRepository(School::class)
            ->findByRspo($data->get('school'));

        if(!count($school))
        {
            return 0;
        }

        $entityManager = $this->getDoctrine()->getManager();

        try {
            $fiche = new Fiche();
            $fiche->setName($data->get('name'));
            $fiche->setSurname($data->get('surname'));
            $fiche->setSchool($school[0]);
            $fiche->setClassDigit($data->get('class_digit'));
            $fiche->setClassLetter($data->get('class_letter'));
            $fiche->setPhone($data->get('phone'));
            $fiche->setMail($data->get('email'));
            $fiche->setChildName($data->get('child_name'));
            $fiche->setChildSurname($data->get('child_surname'));
            $entityManager->persist($fiche);
            $entityManager->flush();
            $newFicheId = $fiche->getId();
        } catch (Exception $e)
        {
            throw new Exception($e->getMessage());
            return $e->getMessage();
        }

        return $newFicheId;
    }

    public function updateAction(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $data = $request->request;
        $ficheId = $data->get('ficheId');

        $fiche = $this->getDoctrine()
            ->getRepository(Fiche::class)
            ->findOneById($ficheId);

        if (!$fiche) {
            throw $this->createNotFoundException(
                'No fiche found for id '.$ficheId
            );
        }

        try {
            $fiche->setName($data->get('name'));
            $fiche->setSurname($data->get('surname'));
            $fiche->setSchool($data->get('school'));
            $fiche->setClassDigit($data->get('class_digit'));
            $fiche->setClassLetter($data->get('class_letter'));
            $fiche->setPhone($data->get('phone'));
            $fiche->setMail($data->get('mail'));
            $fiche->setChildName($data->get('child_name'));
            $fiche->setChildSurname($data->get('child_surname'));
            $entityManager->persist($fiche);
            $entityManager->flush();
        } catch (Exception $e)
        {
            throw new Exception($e->getMessage());
            return $e->getMessage();
        }

        return new Response();
    }

    public function editFicheAction($ficheId)
    {
        $fiche = $this->getDoctrine()
            ->getRepository(Fiche::class)
            ->findById($ficheId);

        $ficheArr = array(
            'name' => $fiche[0]->getName(),
            'surname' => $fiche[0]->getSurname(),
            'email' => $fiche[0]->getEmail(),
            'phone' => $fiche[0]->getPhone(),
            'child_name' => $fiche[0]->getChildName(),
            'child_surname' => $fiche[0]->getChildSurname(),
            'school' => $fiche[0]->getSchool()->getName(),
            'class_digit' => $fiche[0]->getClassDigit(),
            'class_letter' => $fiche[0]->getClassLetter(),
            'id' => $fiche[0]->getId(),
        );

        return $this->render('AdminBundle:Fiche:edit.html.twig', array(
            'action_url' => 'update_fiche',
            'ficheArr' => $ficheArr));
    }

    public function showFicheAction($ficheId)
    {
        $fiche = $this->getDoctrine()
            ->getRepository(Fiche::class)
            ->findById($ficheId);

        $ficheArr = array(
            'name' => $fiche[0]->getName(),
            'surname' => $fiche[0]->getSurname(),
            'email' => $fiche[0]->getMail(),
            'phone' => $fiche[0]->getPhone(),
            'child_name' => $fiche[0]->getChildName(),
            'child_surname' => $fiche[0]->getChildSurname(),
            'school' => $fiche[0]->getSchool()->getName(),
            'class_digit' => $fiche[0]->getClassDigit(),
            'class_letter' => $fiche[0]->getClassLetter(),
            'id' => $fiche[0]->getId(),
        );

        return $this->render('AdminBundle:Fiche:showFiche.html.twig', array(
            'ficheArr' => $ficheArr));
    }

    public function showAction()
    {
        $result = $this->getDoctrine()
            ->getRepository(Fiche::class)
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
                'email' => $row->getMail(),
                'phone' => $row->getPhone(),
                'school' => $row->getSchool()->getName(),
                'class_digit' => $row->getClassDigit(),
                'class_letter' => $row->getClassLetter(),
                'child_name' => $row->getChildName(),
                'child_surname' => $row->getChildSurname()
            );
        }

        return $this->render('AdminBundle:Fiche:show.html.twig', array(
            'ficheArr' => $rows,
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
                $data['fiche.'.$key] = $value;
            }
        }
        var_dump($data);
        $fiche = $this->getDoctrine()
            ->getRepository(Fiche::class)
            ->findBy($data);exit();
        var_dump($fiche); exit();
        $filterManager = new FilterManager($this->getDoctrine());
        $repository = $this->doctrine
            ->getRepository($table);

        $query = $repository->createQueryBuilder('u');
        $query->leftJoin(AppUsers::class, "au", "WITH", "u.fiche=au.id");
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


        $date = $filterManager->findByFilteredData(Fiche::class, $data);

        $products = $this->getDoctrine()
            ->getRepository(Fiche::class)
            ->findByFilteredData($data);
    }
}
