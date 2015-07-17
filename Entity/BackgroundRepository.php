<?php

namespace eDemy\BackgroundBundle\Entity;

use Doctrine\ORM\EntityRepository;

class BackgroundRepository extends EntityRepository
{
    public function findAll($namespace = null)
    {
        $qb = $this->createQueryBuilder('b');
        if($namespace == null) {
            $qb->andWhere('b.namespace is null');
        } else {
            $qb->andWhere('b.namespace = :namespace');
            $qb->setParameter('namespace', $namespace);
        }
        $qb->andWhere('b.published = true');
        $qb->orderBy('b.name','ASC');
        $query = $qb->getQuery();

        return $query->getResult();
    }
}
