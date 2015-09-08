<?php

namespace Atw\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ArticleCategory
 *
 * @ORM\Table(name="article_category", indexes={@ORM\Index(name="idx_article_category_article_id", columns={"article_id"}), @ORM\Index(name="idx_article_category_category_id", columns={"category_id"})})
 * @ORM\Entity(repositoryClass="Atw\TestBundle\Repository\ArticleCategoryRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class ArticleCategory
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="article_category_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

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
     * @var \Article
     *
     * @ORM\ManyToOne(targetEntity="Article", inversedBy="articleCategories")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="article_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $article;

    /**
     * @var \Category
     *
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="articleCategories")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $category;



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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return ArticleCategory
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
     * @return ArticleCategory
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

    /**
     * Set article
     *
     * @param \Atw\TestBundle\Entity\Article $article
     * @return ArticleCategory
     */
    public function setArticle(\Atw\TestBundle\Entity\Article $article = null)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \Atw\TestBundle\Entity\Article 
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set category
     *
     * @param \Atw\TestBundle\Entity\Category $category
     * @return ArticleCategory
     */
    public function setCategory(\Atw\TestBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Atw\TestBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }
}
