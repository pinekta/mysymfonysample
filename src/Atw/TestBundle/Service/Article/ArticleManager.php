<?php

namespace Atw\TestBundle\Service\Article;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Atw\TestBundle\Entity\Article;

/**
 * Class ArticleManager
 */
class ArticleManager implements ArticleManagerInterface
{
    /** @var \Doctrine\ORM\EntityManagerInterface */
    private $em;

    /** @var \Symfony\Component\Validator\Validator\ValidatorInterface */
    private $validator;

    /**
     * @param EntityManagerInterface $em
     * @param ValidatorInterface     $validator
     */
    public function __construct(EntityManagerInterface $em, ValidatorInterface $validator)
    {
        $this->em = $em;
        $this->validator = $validator;
    }

    /**
     * @param Article $article
     * @throws \Exception
     */
    public function tryUpdateInsert(Article $article)
    {
        $this->tryValidate($article);

        $this->em->transactional(function () use ($article) {
            // TODO 画像のアップロード処理必要

            $this->em->persist($article);
        });
    }

    /**
     * @param Article $article
     * @throws \Exception
     */
    public function tryDelete(Article $article)
    {
        $this->tryValidate($article);

        $this->em->transactional(function () use ($article) {
            // TODO 画像の削除処理必要

            $this->em->remove($article);
        });
    }

    private function tryValidate(Article $article)
    {
        $errors = $this->validator->validate($article);
        if (count($errors)) {
            throw new \Exception(implode('\n', $errors));
        }
    }
}
