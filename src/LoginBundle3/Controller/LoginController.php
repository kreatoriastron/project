<?php

namespace LoginBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use LoginBundle\Entity\LessonSchedule;
use LoginBundle\Entity\LessonTimetable;

class LoginController extends Controller
{
	private $em;
	private $qb;
	private $user;
	private $class;
	
	public function construct()
	{
		$this->em = $this->getDoctrine()->getManager();
		$this->qb = $this->em->createQueryBuilder();
		$this->user = $this->get('security.token_storage')->getToken()->getUser();
		$this->class = $this->user->getClass();
	}
	
    public function userPanelAction()
    {

		$lessonSchedule = $this->getLessonSchedule();
		$timetable = $this->getLessonTimetable();
        return $this->render('LoginBundle:Default:userPanel.html.twig',
			array(
				'lessons' => $lessonSchedule,
				'timetable' => $timetable
			));
    }	
	
	private function getLessonSchedule()
	{
		$this->construct();		
		$this->qb->select('lc')
			->from('LoginBundle:LessonSchedule', 'lc')
			->where('lc.classId=?1')
			->setParameter('1', $this->class);	
		return $this->qb->getQuery()->getResult();		
	}
	
	private function getLessonTimetable()
	{
		$this->construct();		
		$this->qb->select('ls')
			->from('LoginBundle:LessonTimetable', 'ls')
			->where('ls.classId=?1')
			->setParameter('1', $this->class);	
		return $this->qb->getQuery()->getResult();			
	}
}
