<?php

/**
 * Created by PhpStorm.
 * User: RUBEN
 * Date: 2018-07-06
 * Time: 15:42
 */

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;

class UserLectorRepository extends EntityRepository
{
    public function findById()
    {
        exit('ddd');
        return $this->_em->createQuery('SELECT u FROM AppBundle\UserLector u')
            ->getResult();
    }
}
