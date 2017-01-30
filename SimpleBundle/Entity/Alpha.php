<?php

namespace Jus\SimpleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Alpha
 *
 * @ORM\Table(name="alpha")
 * @ORM\Entity(repositoryClass="Jus\SimpleBundle\Repository\AlphaRepository")
 */
class Alpha
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var \stdClass
     *
     * @ORM\OneToMany(targetEntity="Beta", mappedBy="alpha",  cascade={"persist"})
     */
    private $betas;


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
     * Set title
     *
     * @param string $title
     *
     * @return Alpha
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
     * Constructor
     */
    public function __construct()
    {
        $this->betas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add beta
     *
     * @param \Jus\SimpleBundle\Entity\Beta $beta
     *
     * @return Alpha
     */
    public function addBeta(\Jus\SimpleBundle\Entity\Beta $beta)
    {
        $this->betas[] = $beta;
        $beta->setAlpha($this);

        return $this;
    }

    /**
     * Remove beta
     *
     * @param \Jus\SimpleBundle\Entity\Beta $beta
     */
    public function removeBeta(\Jus\SimpleBundle\Entity\Beta $beta)
    {
        $this->betas->removeElement($beta);
    }

    /**
     * Get betas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBetas()
    {
        return $this->betas;
    }
}
