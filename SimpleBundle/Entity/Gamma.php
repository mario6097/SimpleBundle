<?php

namespace Jus\SimpleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gamma
 *
 * @ORM\Table(name="gamma")
 * @ORM\Entity(repositoryClass="Jus\SimpleBundle\Repository\GammaRepository")
 */
class Gamma
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
     *
     * @ORM\ManyToOne(targetEntity="Beta", inversedBy="gammas", cascade={"persist"})
     * @ORM\JoinColumn(name="beta_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $beta;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;


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
     * @return Gamma
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
     * Set gamma
     *
     * @param \Jus\SimpleBundle\Entity\Beta $beta
     *
     * @return Gamma
     */
    public function setBeta(\Jus\SimpleBundle\Entity\Beta $beta = null)
    {
        $this->beta = $beta;

        return $this;
    }

    /**
     * Get gamma
     *
     * @return \Jus\SimpleBundle\Entity\Beta
     */
    public function getBeta()
    {
        return $this->beta;
    }
}
