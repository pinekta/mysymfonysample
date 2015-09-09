<?php

namespace Atw\TestBundle\Service\Category;

use Atw\TestBundle\Entity\Category;

/**
 * Interface CategoryManagerInterface
 */
interface CategoryManagerInterface
{
    /**
     * @param Category $category
     * @throws \Exception
     */
    public function tryUpdateInsert(Category $category);

    /**
     * @param Category $category
     * @throws \Exception
     */
    public function tryDelete(Category $category);
}

