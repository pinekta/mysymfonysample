<?php

namespace Atw\TestBundle\Service\Category;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Atw\TestBundle\Entity\Category;

/**
 * Class CategoryManager
 */
class CategoryManager implements CategoryManagerInterface
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
     * @param Category $category
     * @throws \Exception
     */
    public function tryUpdateInsert(Category $category)
    {
        $this->tryValidate($category);

        $this->em->transactional(function () use ($category) {
            $this->em->persist($category);
        });
        // TIPS
        // 複数テーブルの場合transactionalしたほうがよいが
        // 単一の場合はオーバーヘッドのため以下で十分である
        // $this->em->persist($entity);
        // $this->em->flush();
    }

    /**
     * @param Category $category
     * @throws \Exception
     */
    public function tryDelete(Category $category)
    {
        $this->tryValidate($category);

        $this->em->transactional(function () use ($category) {
            $this->em->remove($category);
        });
    }

    private function tryValidate(Category $category)
    {
        $errors = $this->validator->validate($category);
        if (count($errors)) {
            throw new \Exception(implode('\n', $errors));
        }
    }
}
