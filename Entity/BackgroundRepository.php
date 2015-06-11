<?php

namespace eDemy\BackgroundBundle\Entity;

use Doctrine\ORM\EntityRepository;

class BackgroundRepository extends EntityRepository
{
    public function findAll($namespace = null)
    {
        $qb = $this->createQueryBuilder('b');
        $qb->andWhere('b.namespace = :namespace');
        $qb->andWhere('b.published = true');
        $qb->orderBy('b.nombre','ASC');
        $qb->setParameter('namespace', $namespace);
        $query = $qb->getQuery();

        return $query->getResult();
    }
}
