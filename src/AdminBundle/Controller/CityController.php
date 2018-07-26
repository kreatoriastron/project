<?php

namespace AdminBundle\Controller;

use AdminBundle\Controller\User\UserController;
use AppBundle\Entity\City;
use AppBundle\Entity\School;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;

class CityController extends UserController
{
    private $em;

    public function generateListAction()
    {
        $this->em = $this->getDoctrine()->getManager();
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
                $city->setWojewodztwo($result['wojewodztwo']);
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
}
