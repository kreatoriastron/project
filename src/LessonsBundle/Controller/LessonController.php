<?php

namespace LessonsBundle\Controller;

use AppBundle\Entity\GroupList;
use AppBundle\Entity\Lesson;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Service\DBManager\FilterManager;

class LessonController extends Controller
{
    private $group;
    private $lesson;
    private $lessonList;

    public function init($groupId, $lessonId = 0)
    {
        $this->group = $this->getDoctrine()
            ->getRepository(GroupList::class)
            ->findOneById($groupId);

        if (!$this->group) {
            throw $this->createNotFoundException(
                'No group found for id '.$groupId
            );
        }

        if($lessonId) {
            $this->lesson = $this->getDoctrine()
                ->getRepository(Lesson::class)
                ->findOneById($lessonId);

            if (!$this->lesson) {
                throw $this->createNotFoundException(
                    'No lesson found for id '.$groupId
                );
            }
        }
    }

    public function showAction($groupId)
    {
        $this->init($groupId);

        $group = array('id' => $groupId,
            'name' => $this->group->getName());
        $this->setLessonList();

        $rows = array();
        foreach($this->lessonList as $id => $row)
        {
            $rows[] = array(
                'id' => $row->getId(),
                'topic' => $row->getTopic(),
                'date' => $row->getDate()
            );
        }

        return $this->render('LessonsBundle:Lesson:show.html.twig', array(
            'lessons' => $rows,
            'group' => $group));
    }

    public function setLessonList()
    {
        $groupId = $this->group->getId();
        $qb = $this->getDoctrine()
            ->getRepository(Lesson::class)->createQueryBuilder('l');
        $qb->select('l')
            ->where($qb->expr()->in('l.group',$groupId));

        $this->lessonList = $qb->getQuery()->getResult();
    }

    public function editAction($groupId, $lessonId)
    {
        $this->init($groupId, $lessonId);

        $group = array('id' => $groupId,
            'name' => $this->group->getName());

        $lesson = array(
            'id' => $this->lesson->getId(),
            'topic' => $this->lesson->getTopic(),
            'date' => $this->lesson->getDate());

        return $this->render('LessonsBundle:Lesson:edit.html.twig', array(
            'lesson' => $lesson,
            'group' => $group));

    }

    public function updateAction($groupId, $lessonId, Request $request)
    {
        $this->init($groupId, $lessonId);
        $entityManager = $this->getDoctrine()->getManager();
        $data = $request->request;

        try {
            $this->lesson->setTopic($data->get('topic'));
            $this->lesson->setDate($data->get('date'));
            $entityManager->persist($this->group);
            $entityManager->flush();
        } catch (Exception $e)
        {
            throw new Exception($e->getMessage());
            new Response($e->getMessage());
        }

        return new Response('correct');
    }

    public function filterAction(Request $request)
    {
        $data = $request->request->all();


        $filterManager = new FilterManager($this->getDoctrine());
        $filterManager->setTable(array(
            'fullName' =>'AppBundle\Entity\Lesson',
            'shortName' => 'l'));
        $filterManager->setCondition($data, 'l');
        $filterManager->setSelect(array('l'));
        $filteredData = $filterManager->getfilteredData();

        $rows = array();
        foreach($filteredData as $id => $row)
        {
            $rows[] = array(
                'id' => $row->getId(),
                'topic' => $row->getTopic(),
                'date' => $row->getDate(),
            );
        }
        $jsonData = json_encode($rows);

        return new Response($jsonData);
    }
}
