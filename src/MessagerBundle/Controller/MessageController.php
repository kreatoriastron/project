<?php

namespace MessagerBundle\Controller;

use AppBundle\Entity\AppUsers;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Messanger;
use Symfony\Component\HttpFoundation\Request;
use MessagerBundle\Service\SMSManager;
use Symfony\Component\HttpFoundation\Response;

class MessageController extends Controller
{

    public function saveAction(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        try {
            $idList = json_decode($request->get('id'));
            foreach($idList as $id => $userId ) {
                $messenger = new Messanger();
                $messenger->setFromUser('csatut');
                $messenger->setToUser($userId );
                $messenger->setMessage($request->get('content'));
                $messenger->setSendDate(new \DateTime('NOW'));
                $messenger->setStatus('0');
                $messenger->setType('1');
                $entityManager->persist($messenger);
                $entityManager->flush();
            }
        } catch (Exception $e)
        {
            throw new Exception($e->getMessage());
            return $e->getMessage();
        }

        return $this->render('MessagerBundle:Message:success.html.twig');
    }

    public function sendFromQueueAction()
    {
        $smsManager = new SMSManager();
        $unsent = $this->getDoctrine()
            ->getRepository(Messanger::class)
        ->findByStatus(0);

        foreach($unsent as $id => $message){
            $number = $this->getUserNumber($message->getToUser());
            $smsManager->send($number, $message->getMessage());
        }

        return new Response('Prawidłowo zakończono wysyłkę');
    }

    private function getUserNumber($id)
    {
        $user = $this->getDoctrine()
            ->getRepository(AppUsers::class)
            ->findOneById($id);

        if(is_object($user)) {
            return $user->getPhone();
        }

        return 0;
    }
}
