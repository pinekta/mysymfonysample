<?php

namespace Atw\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Atw\TestBundle\Entity\Support\CreateUpdateDtLifeCycleHelperTrait;

/**
 * Category
 *
 * @UniqueEntity(
 *     fields={"categoryCode"},
 *     errorPath="categoryCode",
 *     message="入力されたカテゴリコードは既に使用されています。"
 * )
 * @ORM\Table(name="category", uniqueConstraints={@ORM\UniqueConstraint(name="unique_category_category_code", columns={"category_code"})})
 * @ORM\Entity(repositoryClass="Atw\TestBundle\Repository\CategoryRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Category
{
    use CreateUpdateDtLifeCycleHelperTrait;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="category_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="category_code", type="string", length=64, nullable=false)
     * @Assert\NotBlank(
     *      message = "カテゴリコードを入力してください。"
     * )
     * @Assert\Length(
     *       min = "1",
     *       max = "64",
     *       maxMessage = "カテゴリコードは{{ limit }}文字以内で入力してください。"
     * )
     * @Assert\Regex(
     *     pattern="/^[a-zA-Z0-9_-]+$/",
     *     match=true,
     *     message="カテゴリコードは半角英数字記号（記号はハイフンとアンダーバーのみ使用可能）で入力してください。"
     * )
     */
    private $categoryCode;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=128, nullable=false)
     * @Assert\NotBlank(
     *      message = "カテゴリ名を入力してください。"
     * )
     * @Assert\Length(
     *       max = "128",
     *       maxMessage = "カテゴリ名は{{ limit }}文字以内で入力してください。"
     * )
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetimetz", nullable=false)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetimetz", nullable=false)
     */
    private $updatedAt;

    /**
     * @var \Atw\TestBundle\Entity\ArticleCategory
     *
     * @ORM\OneToMany(targetEntity="\Atw\TestBundle\Entity\ArticleCategory",
     *              mappedBy="category", cascade={"persist", "remove"}
     * )
     */
    private $articleCategories;

    /**
     * construct
     */
    public function __construct()
    {
        $this->articleCategories = new ArrayCollection();
    }

    /**
     * Get articleCategories
     *
     * @return \Atw\TestBundle\Entity\ArticleCategory
     */
    public function getArticleCategories()
    {
        return $this->articleCategories;
    }



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set categoryCode
     *
     * @param string $categoryCode
     * @return Category
     */
    public function setCategoryCode($categoryCode)
    {
        $this->categoryCode = $categoryCode;

        return $this;
    }

    /**
     * Get categoryCode
     *
     * @return string 
     */
    public function getCategoryCode()
    {
        return $this->categoryCode;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Category
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Category
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
