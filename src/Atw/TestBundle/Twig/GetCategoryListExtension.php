<?php

namespace Atw\TestBundle\Twig;

use Doctrine\ORM\EntityManagerInterface;

/**
 * class GetCategoryListExtension
 */
class GetCategoryListExtension extends \Twig_Extension
{
    /** @var \Doctrine\ORM\EntityManagerInterface */
    private $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /*
     * Get name
     */
    public function getName()
    {
        return 'get_category_list_extension';
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            'getCategoryName' => new \Twig_Function_Method($this, 'getCategoryName'),
            'getCategoryList' => new \Twig_Function_Method($this, 'getCategoryList')
        ];
    }

    /**
     * @param string $value
     * @return string
     */
    public function getCategoryName($id)
    {
        if (!preg_match('/^[0-9]+$/', $id)) {
            throw InvalidArgumentException("IDではない値が指定されました");
        }
        $entity = $this->em->getRepository('AtwTestBundle:Category')->find($id);
        return is_null($entity) ? null : $entity->getName();
    }

    /**
     * @param string $selectValue
     * @param boolean $blank
     * @return string
     */
    public function getCategoryList($selectValue = null, $blank = true)
    {
        $entities = $this->em->getRepository('AtwTestBundle:Category')->findNotExpiredList();

        $buf = '<select id="categoryList" name="categoryList" class="dropdown">';
        if ($blank) {
            $buf .= '<option value=""></option>';
        }
        foreach ($entities as $entity) {
            $selected = $selectValue === $entity->getId() ? 'selected' : '';
            $buf .= sprintf('<option value="%d" %s>%s</option>', $entity->getId(), $selected, $entity->getName());
        }
        $buf .= '</select>';
        return $buf;
    }
}
