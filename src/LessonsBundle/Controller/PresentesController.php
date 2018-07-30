<?php

namespace LessonsBundle\Controller;

use AppBundle\Entity\Child;
use AppBundle\Entity\ChildToGroup;
use AppBundle\Entity\GroupList;
use AppBundle\Entity\Lesson;
use AppBundle\Entity\Presence;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PresentesController extends Controller
{
    private $group;
    private $lesson;
    private $em;

    public function init($groupId, $lessonId = 0)
    {
        $this->em = $this->getDoctrine()->getManager();

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

    public function showAction($groupId, $lessonId)
    {
        $this->init($groupId, $lessonId);

        $groupChildArr = $this->getDoctrine()
            ->getRepository(ChildToGroup::class)
            ->findByGrouplist($groupId);

        if(count($groupChildArr) == 0) return 0;

        $childIds = array();
        foreach($groupChildArr as $id => $child){
            $childIds[] = $child->getId();
        }

        $qb = $this->getDoctrine()
            ->getRepository(Child::class)->createQueryBuilder('c');
        $qb->select('c')
            ->where($qb->expr()->in('c.id',$childIds));
        $childListResult = $qb->getQuery()->getResult();

        $childList = array();
        foreach($childListResult as $id => $row)
        {
            $presenceOb = $this->ifPresenceExist($row);
            $presence = false;
            if($presenceOb) {
                $presence = $presenceOb->getPresence();
            }


            $childList[] = array(
                'id' => $row->getId(),
                'name' => $row->getName(),
                'surname' => $row->getSurname(),
                'presence' => $presence
            );
        }

        $group = array('id' => $groupId,
            'name' => $this->group->getName());

        $lesson = array('id' => $lessonId,
            'date' => $this->lesson->getDate(),
            'topic' => $this->lesson->getTopic());

        return $this->render('LessonsBundle:Presentes:presences.html.twig', array(
            'childs' => $childList,
            'group' => $group,
            'lesson' => $lesson));
    }

    public function addAction($groupId, $lessonId, Request $request)
    {
        $this->init($groupId, $lessonId);
        $presences = $request->request->all();

        foreach($presences as $userId => $presence){
            try {
                $presence = str_replace(array('on','off'), array(1,0), $presence);

                $child = $this->getDoctrine()
                    ->getRepository(Child::class)
                    ->findOneById($userId);

                if (!$child) {
                    throw $this->createNotFoundException(
                        'No $child found for id '.$userId
                    );
                }

                $presenceOb = $this->getPresenceObj($child);

                $presenceOb->setGrouplist($this->group);
                $presenceOb->setLesson($this->lesson);
                $presenceOb->setChild($child);
                $presenceOb->setPresence($presence);

                $this->em->persist($presenceOb);
                $this->em->flush();
            } catch (Exception $e)
            {
                throw new Exception($e->getMessage());
                return $e->getMessage();
            }
        }

        return new Response('correct');
    }

    private function getPresenceObj($child)
    {
        $presence = $this->ifPresenceExist($child);
        if(!$presence)
        {
            $presence =  new Presence();
        }

        return $presence;
    }

    private function ifPresenceExist($child)
    {
        $qb = $this->getDoctrine()
            ->getRepository(Presence::class)->createQueryBuilder('p');
        $qb->select('p')
            ->where('p.child = :child')
            ->setParameter('child',$child)
            ->andWhere('p.lesson = :lesson')
            ->setParameter('lesson',$this->lesson)
            ->setMaxResults(1);
        $result = $qb->getQuery()->getResult();

        $presence = (isset($result[0])) ? $result[0] : false;
        return $presence;
    }

    public function editAction()
    {
        return $this->render('LessonsBundle:Default:index.html.twig');
    }
}
