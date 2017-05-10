<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Rool
 *
 * @ORM\Table(name="rools")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RoolsRepository")
 */
class Rools
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
     * @ORM\Column(name="name", type="string", length= 255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Users", mappedBy="Rool")
     */
    private $Users;

    public function __construct()
    {
        $this->Users = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */

    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Rools
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
     * Add event
     *
     * @param \AppBundle\Entity\Users $user
     *
     * @return Rools
     */
    public function addUser(Users $user)
    {
        $this->Users[] = $user;
        return $this;
    }

    /**
     * Remove user
     *
     * @param \AppBundle\Entity\Users $user
     */
    public function removeEvent(Users $user)
    {
        $this->Users->removeElement($user);
    }

    /**
     * Get events
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->Users;
    }
}
