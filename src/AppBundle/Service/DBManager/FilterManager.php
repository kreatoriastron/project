<?php
/**
 * Created by PhpStorm.
 * User: RUBEN
 * Date: 2018-07-09
 * Time: 12:40
 */

namespace AppBundle\Service\DBManager;

use AppBundle\Entity\AppUsers;

class FilterManager
{
    private $doctrine;

    public function __construct($doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function findBy($name)
    {
exit('ddd');
    }

}