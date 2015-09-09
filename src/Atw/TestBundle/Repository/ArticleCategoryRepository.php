<?php

namespace Atw\TestBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Atw\TestBundle\Repository\Support\TryGetEntityTrait;

/**
 * Class ArticleCategoryRepository
 *
 * @package Atw\TestBundle\Repository
 */
class ArticleCategoryRepository extends EntityRepository
{
    use TryGetEntityTrait;
}
