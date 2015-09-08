<?php

namespace Atw\TestBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user_customer")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="corpname", type="string", length=512, nullable=true)
     */
    private $corpname;

    /**
     * @var string
     *
     * @ORM\Column(name="zip", type="string", length=8, nullable=true)
     */
    private $zip;

    /**
     * Set corpname
     *
     * @param string $corpname
     * @return User
     */
    public function setCorpname($corpname)
    {
        $this->corpname = $corpname;

        return $this;
    }

    /**
     * Get corpname
     *
     * @return string 
     */
    public function getCorpname()
    {
        return $this->corpname;
    }

    /**
     * Set zip
     *
     * @param string $zip
     * @return User
     */
    public function setZip($zip)
    {
        $this->zip = $zip;

        return $this;
    }

    /**
     * Get zip
     *
     * @return string 
     */
    public function getZip()
    {
        return $this->zip;
    }
}
