<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\ImportFile;
use Doctrine\ORM\EntityManager;
use AppBundle\Service\SpreadSheet\SpreadSheetService as SpreadSheet;
use AppBundle\Entity\School;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

class DefaultController extends Controller
{

    const ROW_PER_PERSIST = 20;

    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }

    public function processUploadedFileAction()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $file = $this->getDoctrine()
            ->getRepository(ImportFile::class)
            ->findOneBy(array(
                'imported' => 0,
                'inProgress' => 0
            ));

        if (!$file) {
            throw $this->createNotFoundException(
                'No file to process'
            );
        }

        $spreadSheet = new SpreadSheet();
        $spreadSheet->setDir($file->getDir());
        $spreadSheet->setFile($file->getFilename());
        $fileRows = $spreadSheet->readXLS();

        foreach($fileRows as $id=>$row)
        {
            try {
                if (!$entityManager->isOpen()) {
                    $entityManager = $entityManager->create(
                        $entityManager->getConnection(),
                        $entityManager->getConfiguration()
                    );
                }
                $school = new School();
                $school->setRspo($row['rspo']);
                $school->setWojewodztwo($row['wojewodztwo']);
                $school->setPowiat($row['powiat']);
                $school->setGmina($row['gmina']);
                $school->setCity($row['city']);
                $school->setType($row['type']);
                $school->setName($row['name']);
                $school->setAddress($row['address']);
                $school->setZipCode($row['zip-code']);
                $school->setPost($row['post']);
                $school->setPhone($row['phone']);
                $school->setWww($row['www']);
                $school->setPublicznosc($row['publicznosc']);
                $school->setStudentCount($row['student_count']);
                $school->setClassCount($row['class_count']);
                $entityManager->persist($school);
            } catch (Exception $e)
            {
                throw new Exception($e->getMessage());
                return $e->getMessage();
            }

            if(!($id % DefaultController::ROW_PER_PERSIST))
            {
                try {
                    $entityManager->flush();
                }
                catch (UniqueConstraintViolationException $e) {
                    // duplicate
                }
            }
        }

       return new Response('File imported');
    }
}
