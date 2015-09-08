<?php

namespace Atw\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArticleCategories
 *
 * @ORM\Table(name="article_categories", indexes={@ORM\Index(name="idx_article_categories_article_id", columns={"article_id"}), @ORM\Index(name="idx_article_categories_category_id", columns={"category_id"})})
 * @ORM\Entity
 */
class ArticleCategories
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="article_categories_id_seq", allocationSize=1, initialValue=1)
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
     * @var \Articles
     *
     * @ORM\ManyToOne(targetEntity="Articles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="article_id", referencedColumnName="id")
     * })
     */
    private $article;

    /**
     * @var \Categories
     *
     * @ORM\ManyToOne(targetEntity="Categories")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_id", referencedColumnName="id")
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
     * @return ArticleCategories
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
     * @return ArticleCategories
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
     * @param \Atw\TestBundle\Entity\Articles $article
     * @return ArticleCategories
     */
    public function setArticle(\Atw\TestBundle\Entity\Articles $article = null)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \Atw\TestBundle\Entity\Articles 
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set category
     *
     * @param \Atw\TestBundle\Entity\Categories $category
     * @return ArticleCategories
     */
    public function setCategory(\Atw\TestBundle\Entity\Categories $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Atw\TestBundle\Entity\Categories 
     */
    public function getCategory()
    {
        return $this->category;
    }
}
