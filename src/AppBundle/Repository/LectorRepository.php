<?php
/**
 * Created by PhpStorm.
 * User: RUBEN
 * Date: 2018-04-27
 * Time: 13:34
 */

// src/AppBundle/Repository/LectorRepository.php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\UserLector;

class LectorRepository extends EntityRepository
{
    public function add()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $user = new UserLector();
        $user->setUserId(1);
        $user->setSalary(1999);
        $user->setContract(1);
        $user->setEmployeeType(1);
        $user->setLanguageLevel(1);

        $entityManager->persist($user);
        $entityManager->flush();

        return new Response('Saved new product with id '.$user->getId());
    }

    public function refreshUser(UserInterface $user)
    {
        $class = get_class($user);
        if (!$this->supportsClass($class)) {
            throw new UnsupportedUserException(
                sprintf(
                    'Instances of "%s" are not supported.',
                    $class
                )
            );
        }

        return $this->find($user->getId());
    }

    public function supportsClass($class)
    {
        return $this->getEntityName() === $class
        || is_subclass_of($class, $this->getEntityName());
    }
}