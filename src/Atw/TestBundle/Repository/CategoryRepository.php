<?php

namespace Atw\TestBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Atw\TestBundle\Repository\Support\TryGetEntityTrait;

/**
 * Class CategoryRepository
 *
 * @package Atw\TestBundle\Repository
 */
class CategoryRepository extends EntityRepository
{
    use TryGetEntityTrait;

    public function findNotExpiredList($datetime = null, $limit = 0)
    {
        $now = new \DateTime();
        $datetime = $datetime ?: $now->format('Y-m-d H:i:s');

        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('category');
        $qb->from('AtwTestBundle:Category', 'category');
        $qb->where($qb->expr()->orX('category.expiredAt IS NULL', 'category.expiredAt >= :expired_at'));
        $qb->setParameter('expired_at', $datetime);
        $qb->orderBy('category.id', 'ASC');
        if ($limit > 0) {
            $qb->setMaxResults($limit);
        }
        return $qb->getQuery()->getResult();
    }

    /**
     * カテゴリ取得
     * @param array $where
     * @param array $order
     * @return array
     */
    public function findAll($where = [], $order = ['id' => 'DESC'])
    {
        return $this->findBy($where, $order);
    }
}
