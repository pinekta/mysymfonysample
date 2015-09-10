<?php

namespace Atw\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Atw\TestBundle\Entity\Support\CreateUpdateDtLifeCycleHelperTrait;

/**
 * Article
 *
 * @UniqueEntity(
 *     fields={"thumbnailPath"},
 *     errorPath="thumbnailPath",
 *     message="入力されたサムネイルパスは既に使用されています。"
 * )
 * @ORM\Table(name="article", uniqueConstraints={@ORM\UniqueConstraint(name="unique_article_thumbnail_path", columns={"thumbnail_path"})}, indexes={@ORM\Index(name="idx_article_created_at", columns={"created_at"})})
 * @ORM\Entity(repositoryClass="Atw\TestBundle\Repository\ArticleRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Article
{
    use CreateUpdateDtLifeCycleHelperTrait;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="article_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=128, nullable=false)
     * @Assert\NotBlank(
     *      message = "タイトルを入力してください。"
     * )
     * @Assert\Length(
     *       min = "1",
     *       max = "128",
     *       maxMessage = "タイトルは{{ limit }}文字以内で入力してください。"
     * )
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=256, nullable=false)
     * @Assert\NotBlank(
     *      message = "詳細を入力してください。"
     * )
     * @Assert\Length(
     *       min = "1",
     *       max = "256",
     *       maxMessage = "詳細は{{ limit }}文字以内で入力してください。"
     * )
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=512, nullable=false)
     * @Assert\NotBlank(
     *      message = "URLを入力してください。"
     * )
     * @Assert\Length(
     *      min = 1,
     *      max = 512,
     *      exactMessage = "URLは512文字以内で入力してください。",
     *      minMessage   = "URLは512文字以内で入力してください。",
     *      maxMessage   = "URLは512文字以内で入力してください。",
     * )
     * @Assert\Regex(
     *     pattern = "/^[ -~]+$/iu",
     *     message = "URLは半角英数記号のみ入力可能です。"
     * )
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="thumbnail_path", type="string", length=256, nullable=true)
     */
    private $thumbnailPath;

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
     *              mappedBy="article", cascade={"persist", "remove"}
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
     * Set title
     *
     * @param string $title
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Article
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Article
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set thumbnailPath
     *
     * @param string $thumbnailPath
     * @return Article
     */
    public function setThumbnailPath($thumbnailPath)
    {
        $this->thumbnailPath = $thumbnailPath;

        return $this;
    }

    /**
     * Get thumbnailPath
     *
     * @return string 
     */
    public function getThumbnailPath()
    {
        return $this->thumbnailPath;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Article
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
     * @return Article
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
