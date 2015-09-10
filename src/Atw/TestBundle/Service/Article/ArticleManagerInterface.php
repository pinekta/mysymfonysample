<?php

namespace Atw\TestBundle\Service\Article;

use Atw\TestBundle\Entity\Article;

/**
 * Interface ArticleManagerInterface
 */
interface ArticleManagerInterface
{
    /**
     * @param Article $article
     * @throws \Exception
     */
    public function tryUpdateInsert(Article $article);

    /**
     * @param Article $article
     * @throws \Exception
     */
    public function tryDelete(Article $article);
}
