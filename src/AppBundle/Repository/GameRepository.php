<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Game;

/**
 * GameRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class GameRepository extends \Doctrine\ORM\EntityRepository
{

    public function persist(Game $entity)
    {
        $this->_em->persist($entity);
    }

    public function save(Game $entity = null)
    {
        if($entity) $this->persist($entity);
        $this->_em->flush();
    }

    public function remove(Game $entity)
    {
        $this->_em->remove($entity);
        $this->_em->flush();
    }
}
