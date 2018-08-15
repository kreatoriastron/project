<?php
/**
 * Created by PhpStorm.
 * User: RUBEN
 * Date: 2018-06-18
 * Time: 11:07
 */

namespace MessagerBundle\Service;

use SMSApi\Client;
use SMSApi\Api\SmsFactory;
use SMSApi\Exception\SmsapiException;

class SMSManager
{
    const TOKEN = 'VyQoacCbpKB7ATR3h8yS2pFZY8It8hys3pZNJtY2';

    private $smsapi;

    public function __construct()
    {
        $client = Client::createFromToken(SMSManager::TOKEN);
        $this->smsapi = new SmsFactory;
        $this->smsapi->setClient($client);
    }

    public function send($number, $text)
    {
        try {
            $actionSend = $this->smsapi->actionSend();

            $actionSend->setTo($number);
            $actionSend->setText($text);
            $actionSend->setSender('EdWings'); //Pole nadawcy, lub typ wiadomości: 'ECO', '2Way'

            $response = $actionSend->execute();

            foreach ($response->getList() as $status) {
                echo $status->getNumber() . ' ' . $status->getPoints() . ' ' . $status->getStatus();
            }
        } catch (SmsapiException $exception) {
            echo 'ERROR: ' . $exception->getMessage();
        }
    }
}