<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Round;

/**
 * RoundRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RoundRepository extends \Doctrine\ORM\EntityRepository
{
    public function persist(Round $entity)
    {
        $this->_em->persist($entity);
    }

    public function save(Round $entity = null)
    {
        if($entity) $this->persist($entity);
        $this->_em->flush();
    }

    public function remove(Round $entity)
    {
        $this->_em->remove($entity);
        $this->_em->flush();
    }
}
