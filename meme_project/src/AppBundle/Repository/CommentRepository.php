<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Post;
use Doctrine\ORM\EntityRepository;

/**
 * CommentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CommentRepository extends EntityRepository
{
    public function findAllAssignedToPostSortedByDate(Post $post)
    {
        return $this->createQueryBuilder('c')
            ->where('c.post = :id')
            ->orderBy('c.addedAt', 'DESC')
            ->setParameter('id', $post->getId())
            ->getQuery()->getResult();
    }
}
