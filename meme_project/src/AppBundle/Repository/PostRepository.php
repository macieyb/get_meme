<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * PostRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PostRepository extends EntityRepository
{
    public function findAllSortedByDate()
    {
        return $this->findBy([], ['createdAt' => 'ASC']);
    }
}
