<?php

namespace Jus\SimpleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Beta
 *
 * @ORM\Table(name="beta")
 * @ORM\Entity(repositoryClass="Jus\SimpleBundle\Repository\BetaRepository")
 */
class Beta
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
     * @ORM\ManyToOne(targetEntity="Alpha", inversedBy="betas", cascade={"persist"})
     * @ORM\JoinColumn(name="alpha_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $alpha;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="Gamma", mappedBy="beta", cascade={"persist"})
     */
    private $gammas;


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
     * @return Beta
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
     * @param string $gamma
     *
     * @return Beta
     */
    public function setGamma($gamma)
    {
        $this->gamma = $gamma;

        return $this;
    }

    /**
     * Get gamma
     *
     * @return string
     */
    public function getGamma()
    {
        return $this->gamma;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->gammas = new \Doctrine\Common\Collections\ArrayCollection();
    }



    /**
     * Add gamma
     *
     * @param \Jus\SimpleBundle\Entity\Gamma $gamma
     *
     * @return Beta
     */
    public function addGamma(\Jus\SimpleBundle\Entity\Gamma $gamma)
    {
        $this->gammas[] = $gamma;
	$gamma->setBeta($this);
        return $this;
    }

    /**
     * Remove gamma
     *
     * @param \Jus\SimpleBundle\Entity\Gamma $gamma
     */
    public function removeGamma(\Jus\SimpleBundle\Entity\Gamma $gamma)
    {
        $this->gammas->removeElement($gamma);
    }

    /**
     * Get gammas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGammas()
    {
        return $this->gammas;
    }

    /**
     * Set alpha
     *
     * @param \Jus\SimpleBundle\Entity\Alpha $alpha
     *
     * @return Beta
     */
    public function setAlpha(\Jus\SimpleBundle\Entity\Alpha $alpha = null)
    {
        $this->alpha = $alpha;

        return $this;
    }

    /**
     * Get alpha
     *
     * @return \Jus\SimpleBundle\Entity\Alpha
     */
    public function getAlpha()
    {
        return $this->alpha;
    }
}
