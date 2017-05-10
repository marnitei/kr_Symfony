<?php
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */

class Users
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=50)
     */
    private $login;

    /**
     * @ORM\Column(name="password", type="string", length=255)
     */

    private $password;

    /**
     * @ORM\ManyToOne(targetEntity="Users", inversedBy="Rool")
     * @ORM\JoinColumn(name="rool_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $Rool;

    public function getId()
    {
        return $this->id;
    }

    /**
     * Set login
     *
     * @param string $login
     *
     * @return Users
     */
    public function setLogin($login)
    {
        $this->login = $login;
        return $this;
    }

    /**
     * Get login
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set rool
     *
     * @param \AppBundle\Entity\Rools $rool
     *
     * @return Users
     */
    public function setRool(Rools $rool = null)
    {
        $this->Rools = $rool;
        return $this;
    }

    /**
     * Get rool
     *
     * @return \AppBundle\Entity\Rools
     */
    public function getRool()
    {
        return $this->Rools;
    }


}