<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10.05.2017
 * Time: 19:17
 */

namespace AppBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;

class Category
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
     * @ORM\Column(name="name", type="string", length=25, unique=true)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Reques", mappedBy="Category")
     */
    private $Reques;

    public function __construct()
    {
        $this->Reques = new ArrayCollection();
    }
    /**
     * Add reque
     *
     * @param \AppBundle\Entity\Reques $reque
     *
     * @return Category
     */
    public function addReque(Reques $reque)
    {
        $this->Reques[] = $reque;

        return $this;
    }

    /**
     * Remove reque
     *
     * @param \AppBundle\Entity\Reques $reque
     */
    public function removeReque(Reques $reque)
    {
        $this->Reques->removeElement($reque);
    }

    /**
     * Get Reques
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReques()
    {
        return $this->Reques;
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
}