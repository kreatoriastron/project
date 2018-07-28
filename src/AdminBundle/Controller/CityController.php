<?php

namespace AdminBundle\Controller;

use AdminBundle\Controller\User\UserController;
use AppBundle\Entity\City;
use AppBundle\Entity\School;
use AppBundle\Entity\Wojewodztwo;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\Query;

class CityController extends UserController
{
    private $em;
    private $wojewodztwa;

    public function generateListAction()
    {
        $this->em = $this->getDoctrine()->getManager();
        $this->generateWojewodztwa();
        $this->removeCities();
        $this->generateCities();

        return new Response('Data Generated');
    }

    private function removeCities()
    {
        $results = $this->getDoctrine()
            ->getRepository(City::class)
            ->createQueryBuilder('c')
            ->select('c')
            ->getQuery()
            ->getResult();

        foreach ($results as $result){
            $this->em->remove($result);
        }

        $this->em->flush();
    }

    private function generateCities()
    {
        $results = $this->getDoctrine()
            ->getRepository(School::class)
            ->createQueryBuilder('s')
            ->select('IDENTITY(s.wojewodztwo) as wojewodztwo, s.powiat, s.gmina, s.city')
            ->where('s.type=:type')
            ->setParameter('type','00003')
            ->groupBy('s.wojewodztwo, s.powiat, s.gmina, s.city')
            ->getQuery()
            ->getResult();

        try {
            foreach($results as $id => $result)
            {
                $city = new City();
                $wojObj = $this->wojewodztwa[$result['wojewodztwo']];
                $city->setWojewodztwo($wojObj);
                $city->setPowiat($result['powiat']);
                $city->setGmina($result['gmina']);
                $city->setCity($result['city']);
                $this->em->persist($city);
            }
            $this->em->flush();
        } catch (Exception $e)
        {
            throw new Exception($e->getMessage());
            return $e->getMessage();
        }
    }

    private function generateWojewodztwa()
    {
        $results = $this->getDoctrine()
            ->getRepository(Wojewodztwo::class)
            ->createQueryBuilder('w')
            ->select('w')
            ->getQuery()
            ->getResult(Query::HYDRATE_OBJECT);

        foreach ($results as $result){
            $this->wojewodztwa[$result->getId()] = $result;
        }
    }

}
