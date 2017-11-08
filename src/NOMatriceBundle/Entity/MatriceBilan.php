<?php

namespace NOMatriceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MatriceBilan
 *
 * @ORM\Table(name="matrice_bilan")
 * @ORM\Entity(repositoryClass="NOMatriceBundle\Repository\MatriceBilanRepository")
 */
class MatriceBilan
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
     * @ORM\Column(name="force_mat", type="text",nullable=true)
     */
    private $force;


    /**
     * @var string
     *
     * @ORM\Column(name="weakness", type="text",nullable=true)
     */
    private $weakness;


    /**
     * @var string
     *
     * @ORM\Column(name="opportunity", type="text",nullable=true)
     */
    private $opportunity;


    /**
     * @var string
     *
     * @ORM\Column(name="threat", type="text",nullable=true)
     */
    private $threat;


   

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
     * Set force
     *
     * @param string $force
     *
     * @return MatriceBilan
     */
    public function setForce($force)
    {
        $this->force = $force;

        return $this;
    }

    /**
     * Get force
     *
     * @return string
     */
    public function getForce()
    {
        return $this->force;
    }

    /**
     * Set weakness
     *
     * @param string $weakness
     *
     * @return MatriceBilan
     */
    public function setWeakness($weakness)
    {
        $this->weakness = $weakness;

        return $this;
    }

    /**
     * Get weakness
     *
     * @return string
     */
    public function getWeakness()
    {
        return $this->weakness;
    }

    /**
     * Set opportunity
     *
     * @param string $opportunity
     *
     * @return MatriceBilan
     */
    public function setOpportunity($opportunity)
    {
        $this->opportunity = $opportunity;

        return $this;
    }

    /**
     * Get opportunity
     *
     * @return string
     */
    public function getOpportunity()
    {
        return $this->opportunity;
    }

    /**
     * Set threat
     *
     * @param string $threat
     *
     * @return MatriceBilan
     */
    public function setThreat($threat)
    {
        $this->threat = $threat;

        return $this;
    }

    /**
     * Get threat
     *
     * @return string
     */
    public function getThreat()
    {
        return $this->threat;
    }

   
}
