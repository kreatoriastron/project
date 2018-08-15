<?php

namespace AdminBundle\Controller;

use AppBundle\Entity\Child;
use AppBundle\Entity\ChildToGroup;
use AppBundle\Entity\GroupLesson;
use AppBundle\Entity\LessonSelectedToChild;
use AppBundle\Entity\School;
use AppBundle\Entity\Week;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\AppUsers;
use AppBundle\Entity\UserLector;
use AppBundle\Entity\City;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\GroupList;
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

        $cities = $this->getCities();
        $days = $this->getWeek();
        $lectors = $this->getLectors();

        return $this->render('AdminBundle:Group:add.html.twig', array(
            'action_url' => 'add_group',
            'cities' => $cities,
            'days' => $days,
            'lectors' => $lectors));
    }

    private function getCities()
    {
        $results = $this->getDoctrine()
            ->getRepository(City::class)
            ->createQueryBuilder('c')
            ->select('c')
            ->getQuery()
            ->getResult();
        $cities = array();

        foreach($results as $id => $city)
        {
            $cities[] = array(
                'id' => $city->getId(),
                'city' => $city->getCity(),
                'wojewodztwo' => $city->getWojewodztwo()->getName()
            );
        }

        return $cities;
    }

    private function getWeek()
    {
        $results = $this->getDoctrine()
            ->getRepository(Week::class)
            ->createQueryBuilder('w')
            ->select('w')
            ->getQuery()
            ->getResult();
        $cities = array();

        foreach($results as $id => $day)
        {
            $days[] = array(
                'id' => $day->getId(),
                'name' => $day->getName(),
            );
        }

        return $days;
    }

    private function getLectors()
    {
        $results = $this->getDoctrine()
            ->getRepository(UserLector::class)
            ->createQueryBuilder('l')
            ->select('l')
            ->getQuery()
            ->getResult();
        $lectors = array();

        foreach($results as $id => $lector)
        {
            $name = $lector->getUser()->getName() . ' ' . $lector->getUser()->getSurname();
            $lectors[] = array(
                'id' => $lector->getId(),
                'name' => $name,
            );
        }

        return $lectors;
    }

    private function save($data)
    {
        $formManager = new FormManager();
        $entityManager = $this->getDoctrine()->getManager();
        $school = $this->getDoctrine()
            ->getRepository(School::class)
            ->findOneById($data->get('school'));
        $lector = $this->getDoctrine()
            ->getRepository(UserLector::class)
            ->findOneById($data->get('lector'));

        try {
            $group = new GroupList();
            $group->setName($data->get('name'));
            $group->setSchool($school);
            $group->setUserLector($lector);
            $group->setCost($formManager->getValueInGrosz($data->get('cost')));
            $group->setSumCost($formManager->getValueInGrosz($data->get('sum_cost')));
            $entityManager->persist($group);
            $entityManager->flush();
            $newGroupId = $group->getId();

            $days = $data->get('day');
            $hours = $data->get('hour');
            $classes = $data->get('class');
            foreach($days as $id => $row) {
                $day = $this->getDoctrine()
                    ->getRepository(Week::class)
                    ->findOneById($days[$id]);
                $groupLesson = new GroupLesson();
                $groupLesson->setGroup($group);
                $groupLesson->setClass($classes[$id]);
                $groupLesson->setDay($day);
                $groupLesson->setHour($hours[$id]);
                $entityManager->persist($groupLesson);
            }
            $entityManager->flush();
        } catch (Exception $e)
        {
            throw new Exception($e->getMessage());
            return $e->getMessage();
        }

        return $newGroupId;
    }

    public function updateAction(Request $request)
    {
        $formManager = new FormManager();
        $entityManager = $this->getDoctrine()->getManager();
        $data = $request->request;
        $groupId = $data->get('groupId');

        $group = $this->getDoctrine()
            ->getRepository(GroupList::class)
            ->findOneById($groupId);

        if (!$group) {
            throw $this->createNotFoundException(
                'No group found for id '.$groupId
            );
        }

        $school = $this->getDoctrine()
            ->getRepository(School::class)
            ->findOneById($data->get('school'));
        $lector = $this->getDoctrine()
            ->getRepository(UserLector::class)
            ->findOneById($data->get('lector'));

        try {
            $group->setSchool($school);
            $group->setUserLector($lector);
            $group->setName($data->get('name'));
            $group->setCost($formManager->getValueInGrosz($data->get('cost')));
            $group->setSumCost($formManager->getValueInGrosz($data->get('sum_cost')));
            $entityManager->persist($group);
            $entityManager->flush();
            $groupId = $group->getId();

            $days = $data->get('day');
            $hours = $data->get('hour');
            $classes = $data->get('class');
            $glId = $data->get('groupLessonId');
            foreach($days as $id => $row) {
                $day = $this->getDoctrine()
                    ->getRepository(Week::class)
                    ->findOneById($days[$id]);

                $groupLesson = $this->getDoctrine()
                    ->getRepository(GroupLesson::class)
                    ->findOneById($glId[$id]);

                $groupLesson->setGroup($group);
                $groupLesson->setClass($classes[$id]);
                $groupLesson->setDay($day);
                $groupLesson->setHour($hours[$id]);
                $entityManager->persist($groupLesson);
            }
            $entityManager->flush();

            if(!empty($data->get('new_day')))
            {
                $day = $this->getDoctrine()
                    ->getRepository(Week::class)
                    ->findOneById($data->get('new_day'));
                $groupLesson = new GroupLesson();
                $groupLesson->setGroup($group);
                $groupLesson->setClass($data->get('new_class'));
                $groupLesson->setDay($day);
                $groupLesson->setHour($data->get('new_hour'));
                $entityManager->persist($groupLesson);
                $entityManager->flush();
            }

        } catch (Exception $e)
        {
            throw new Exception($e->getMessage());
            new Response($e->getMessage());
        }

        return new Response($groupId);
    }

    public function editGroupAction($groupId)
    {
        $formManager = new FormManager();
        $group = $this->getDoctrine()
            ->getRepository(GroupList::class)
            ->findOneById($groupId);

        $name = $group->getUserLector()->getUser()->getName() . ' ' . $group->getUserLector()->getUser()->getSurname();
        $lessonList = $this->getGroupLesson($groupId);
        $groupArr = array(
            'name' => $group->getName(),
            'school' => $group->getSchool()->getName(),
            'school_id' => $group->getSchool()->getId(),
            'lector' => $name,
            'lector_id' => $group->getUserLector()->getId(),
            'id' => $group->getId(),
            'cost' => $formManager->getValueInZloty($group->getCost()),
            'sumCost' => $formManager->getValueInZloty($group->getSumCost()),
            'lessonList' => $lessonList

        );

        $cities = $this->getCities();
        $days = $this->getWeek();
        $lectors = $this->getLectors();
        $childList = $this->getChildToGroup($groupId);

        return $this->render('AdminBundle:Group:edit.html.twig', array(
            'action_url' => 'update_group',
            'groupArr' => $groupArr,
            'cities' => $cities,
            'days' => $days,
            'lectors' => $lectors,
            'childs' => $childList,
            'group_name' => $group->getName()));
    }

    private function getChildToGroup($groupId)
    {
        $ctgResult = $this->getDoctrine()
            ->getRepository(ChildToGroup::class)
            ->findByGrouplist($groupId);

        if(count($ctgResult) == 0) return 0;

        $childIds = array();
        foreach($ctgResult as $id => $ctg){
            $childIds[] = $ctg->getChild()->getId();
        }

        $qb = $this->getDoctrine()
            ->getRepository(Child::class)->createQueryBuilder('c');
        $qb->select('c')
            ->where($qb->expr()->in('c.id',$childIds));
        $childList = $qb->getQuery()->getResult();

        $rows = array();
        foreach($childList as $id => $row)
        {
            //if kid in group yet
            $childGroup = $this->getDoctrine()
                ->getRepository(ChildToGroup::class)
                ->findOneByChild($row->getId());

            $rows[] = array(
                'id' => $row->getId(),
                'name' => $row->getName(),
                'surname' => $row->getSurname(),
                'parent_name' => $row->getParent()->getUser()->getName(),
                'parent_surname' => $row->getParent()->getUser()->getSurname(),
                'parent_phone' => $row->getParent()->getUser()->getPhone(),
                'parent_mail' => $row->getParent()->getUser()->getEmail(),
                'class_digit' => $row->getClassDigit(),
                'class_letter' => $row->getClassLetter(),
            );
        }

        return $rows;
    }
    public function showGroupAction($groupId)
    {
        $group = $this->getDoctrine()
            ->getRepository(GroupList::class)
            ->findOneById($groupId);
        $lessonList = $this->getGroupLesson($groupId);

        $name = $group->getUserLector()->getUser()->getName() . ' ' . $group->getUserLector()->getUser()->getSurname();
        $groupArr = array(
            'name' => $group->getName(),
            'school' => $group->getSchool()->getName(),
            'lector' => $name,
            'lessonList' => $lessonList,
            'id' => $group->getId()
        );

        return $this->render('AdminBundle:Group:showGroup.html.twig', array(
            'groupArr' => $groupArr));
    }

    public function showAction()
    {
        $result = $this->getDoctrine()
            ->getRepository(GroupList::class)
            ->createQueryBuilder('g')
            ->select('g')
            ->getQuery()
            ->getResult();

        $rows = array();

        foreach($result as $id => $row)
        {
            $lectorName = $row->getUserLector()->getUser()->getName() . ' ' . $row->getUserLector()->getUser()->getSurname();
            $rows[] = array(
                'id' => $row->getId(),
                'name' => $row->getName(),
                'school' => $row->getSchool()->getName(),
                'lector' => $lectorName
            );
        }

        return $this->render('AdminBundle:Group:show.html.twig', array(
            'groups' => $rows));
    }

    private function getGroupLesson($groupId)
    {
        $groupLesson = $this->getDoctrine()
            ->getRepository(GroupLesson::class)
            ->findByGroup($groupId);

        $lessonList = array();
        foreach($groupLesson as $id => $lesson)
        {
            $lessonList[] = array(
                'id' => $lesson->getId(),
                'class' => $lesson->getClass(),
                'day' => $lesson->getDay()->getName(),
                'dayId' => $lesson->getDay()->getId(),
                'hour' => $lesson->getHour()
            );
        }

        return $lessonList;
    }

    public function filterAction(Request $request)
    {
        $conditionTypeUser['name_or_first'] = 'OR';
        $conditionTypeUser['surname_or_first'] = 'OR';

        $dataGroup['name'] = $request->request->get('name');
        $dataGroup['room'] = $request->request->get('room');
        $dataGroup['hour'] = $request->request->get('hour');
        $dataSchool['name'] = $request->request->get('school');
        $dataUser['name_or_first'] = $request->request->get('lector');
        $dataUser['surname_or_first'] = $request->request->get('lector');
        $dataDay['name'] = $request->request->get('day');

        $filterManager = new FilterManager($this->getDoctrine());
        $filterManager->setTable(array(
            'fullName' =>'AppBundle\Entity\GroupList',
            'shortName' => 'g'));
        $filterManager->setJoin(array(
                'g.school' => 's'));
        $filterManager->setJoin(array(
            'g.userLector' => 'l'));
        $filterManager->setJoin(array(
            'g.day' => 'd'));
        $filterManager->setJoin(array(
            'l.user' => 'u'));
        $filterManager->setCondition($dataGroup, 'g');
        $filterManager->setCondition($dataSchool, 's');
        $filterManager->setCondition($dataUser, 'u', $conditionTypeUser);
        $filterManager->setCondition($dataDay, 'd');
        $filterManager->setSelect(array('g'));
        $filteredData = $filterManager->getfilteredData();

        $rows = array();
        foreach($filteredData as $id => $row)
        {
            $lectorName = $row->getUserLector()->getUser()->getName() . ' ' . $row->getUserLector()->getUser()->getSurname();
            $rows[] = array(
                'id' => $row->getId(),
                'name' => $row->getName(),
                'school' => $row->getSchool()->getName(),
                'lector' => $lectorName,
                'room' => $row->getRoom(),
                'day' => $row->getDay()->getName(),
                'hour' => $row->getHour()
            );
        }
        $jsonData = json_encode($rows);

        return new Response($jsonData);
    }

    public function assignLectorAction(Request $request)
    {

    }

    public function assignChildAction($groupId, Request $request)
    {
        $childs = $request->request->get('id');

        if ($childs)
        {
            $this->addChild($childs, $groupId);
            return new Response('correct');
        }

        $group = $this->getDoctrine()
            ->getRepository(GroupList::class)
            ->findOneById($groupId);

        $schoolId = $group->getSchool()->getId();

        $childList = $this->getDoctrine()
            ->getRepository(Child::class)
            ->findBySchool($schoolId);

        $rows = array();
        foreach($childList as $id => $row)
        {
            //if kid in group yet
            $childGroup = $this->getDoctrine()
                ->getRepository(ChildToGroup::class)
                ->findOneByChild($row->getId());
            $childGroupName = ($childGroup) ? $childGroup->getGroupList()->getName() : '-';
            $rows[] = array(
                'id' => $row->getId(),
                'name' => $row->getName(),
                'surname' => $row->getSurname(),
                'parent_name' => $row->getParent()->getUser()->getName(),
                'parent_surname' => $row->getParent()->getUser()->getSurname(),
                'parent_phone' => $row->getParent()->getUser()->getPhone(),
                'parent_mail' => $row->getParent()->getUser()->getEmail(),
                'class_digit' => $row->getClassDigit(),
                'class_letter' => $row->getClassLetter(),
                'group' => $childGroupName,
            );
        }

        return $this->render('AdminBundle:Group:assignChild.html.twig', array(
            'action_url' => 'assign_child_to_group',
            'childs' => $rows,
            'group_name' => $group->getName(),
            'group_id' => $group->getId()));
    }

    private function addChild($childs, $groupId)
    {
        $entityManager = $this->getDoctrine()->getManager();

        foreach ($childs as $id => $childId)
        {
            try {
                $childToGroup = $this->getDoctrine()
                    ->getRepository(ChildToGroup::class)
                    ->findOneById($childId);

                $child = $this->getDoctrine()
                    ->getRepository(Child::class)
                    ->findOneById($childId);

                if($childToGroup === null) {
                    $childToGroup = new ChildToGroup();
                    $childToGroup->setChild($child);
                }

                $group = $this->getDoctrine()
                    ->getRepository(GroupList::class)
                    ->findOneById($groupId);

                $childToGroup->setGrouplist($group);
                $entityManager->persist($childToGroup);
                $entityManager->flush();

                $this->setLstc($child, $groupId, $entityManager);

            } catch (Exception $e)
            {
                throw new Exception($e->getMessage());
                return new Response($e->getMessage());
            }
        }
        return 1;
    }

    private function setLstc($child, $groupId, $em)
    {
        $lstg = $this->getDoctrine()
            ->getRepository(LessonSelectedToChild::class)
            ->findByChild($child->getId());

        foreach($lstg as  $id => $record)
        {
            $em->remove($record);
        }

        $em->flush();

        $groupLesson = $this->getDoctrine()
            ->getRepository(GroupLesson::class)
            ->findByGroup($groupId);

        foreach($groupLesson as $id => $lesson)
        {
            $lstg = new LessonSelectedToChild();
            $lstg->setChild($child);
            $lstg->setGroupLesson($lesson);
            $em->persist($lstg);

        }
        $em->flush();

        return true;
    }

    public function filterChildToGroupAction($groupId, Request $request)
    {
        $group = $this->getDoctrine()
            ->getRepository(GroupList::class)
            ->findOneById($groupId);

        $schoolId = $group->getSchool()->getId();

        $conditionChild['school'] = 'EQUAL';
        $conditionChild['class_digit'] = 'EQUAL';

        $dataChild['name'] = $request->request->get('name');
        $dataChild['surname'] = $request->request->get('surname');
        $dataChild['classDigit'] = $request->request->get('classDigit');
        $dataChild['classLetter'] = $request->request->get('classLetter');
        $dataChild['school'] = $schoolId;
        $dataUserParent['name'] = $request->request->get('parentName');
        $dataUserParent['surname'] = $request->request->get('parentSurname');
        $dataUserParent['phone'] = $request->request->get('phone');
        $dataUserParent['email'] = $request->request->get('email');
        $dataChildToGroup['group'] = $request->request->get('group');


        try{
            $filterManager = new FilterManager($this->getDoctrine());
            $filterManager->setTable(array(
                'fullName' =>'AppBundle\Entity\Child',
                'shortName' => 'c'));
            $filterManager->setJoin(array(
                'c.parent' => 'p'));
            $filterManager->setJoin(array(
                'p.user' => 'u'));
            $filterManager->setCondition($dataChild, 'c', $conditionChild);
            $filterManager->setCondition($dataUserParent, 'u');
            $filterManager->setSelect(array('c, p, u'));
            $filteredData = $filterManager->getfilteredData();

            $rows = array();
            foreach($filteredData as $id => $row)
            {
                $rows[] = array(
                    'id' => $row->getId(),
                    'name' => $row->getName(),
                    'surname' => $row->getSurname(),
                    'parent_name' => $row->getParent()->getUser()->getName(),
                    'parent_surname' => $row->getParent()->getUser()->getSurname(),
                    'parent_phone' => $row->getParent()->getUser()->getPhone(),
                    'parent_mail' => $row->getParent()->getUser()->getEmail(),
                    'class_digit' => $row->getClassDigit(),
                    'class_letter' => $row->getClassLetter(),
                    'group' => $group->getName(),
                );
            }
            $jsonData = json_encode($rows);

            return new Response($jsonData);

            return new Response('correct');
        } catch (Exception $e)
        {
            throw new Exception($e->getMessage());

            return new Response($e->getMessage());
        }
    }

    public function removeChildAction($groupId, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $userId = $request->request->get('userId');

        $childToGroup = $em->getRepository(ChildToGroup::class)
            ->findOneBy(array('grouplist'=>$groupId,'child'=>$userId));

        if (!$childToGroup) {
            throw $this->createNotFoundException(
                'No child found in group '.$groupId
            );
        }
        $em->remove($childToGroup);
        $em->flush();

        return new Response('correct');
    }

}
