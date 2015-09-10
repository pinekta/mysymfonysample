<?php

namespace Atw\TestBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Atw\TestBundle\Repository\Support\TryGetEntityTrait;

/**
 * Class ArticleRepository
 *
 * @package Atw\TestBundle\Repository
 */
class ArticleRepository extends EntityRepository
{
    use TryGetEntityTrait;

    public function findAll($where = [], $order = ['id' => 'DESC'])
    {
        return $this->findBy($where, $order);
    }
}
