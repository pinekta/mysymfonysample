<?php

namespace Atw\TestBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class CategoryRepository
 *
 * @package Atw\TestBundle\Repository
 */
class CategoryRepository extends EntityRepository
{
    /**
     * カテゴリ取得
     * @param array $where
     * @param array $order
     * @return array
     */
    public function findAll($where = [], $order = ['id' => 'DESC'])
    {
        // TODO change method name
        return $this->findBy($where, $order);
    }
}
