<?php

namespace NOMatriceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Matrice
 *
 * @ORM\Table(name="matrice")
 * @ORM\Entity(repositoryClass="NOMatriceBundle\Repository\MatriceRepository")
 */
class Matrice
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
    * @ORM\OneToOne(targetEntity="NOMatriceBundle\Entity\PoliticalMatrice")
    */
    private $politicalMatrice;


    /**
    * @ORM\OneToOne(targetEntity="NOMatriceBundle\Entity\EconomicalMatrice")
    */
    private $economicalMatrice;


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
     * Set politicalMatrice
     *
     * @param \NOMatriceBundle\Entity\PoliticalMatrice $politicalMatrice
     *
     * @return Matrice
     */
    public function setPoliticalMatrice(\NOMatriceBundle\Entity\PoliticalMatrice $politicalMatrice = null)
    {
        $this->politicalMatrice = $politicalMatrice;

        return $this;
    }

    /**
     * Get politicalMatrice
     *
     * @return \NOMatriceBundle\Entity\PoliticalMatrice
     */
    public function getPoliticalMatrice()
    {
        return $this->politicalMatrice;
    }

    /**
     * Set economicalMatrice
     *
     * @param \NOMatriceBundle\Entity\EconomicalMatrice $economicalMatrice
     *
     * @return Matrice
     */
    public function setEconomicalMatrice(\NOMatriceBundle\Entity\EconomicalMatrice $economicalMatrice = null)
    {
        $this->economicalMatrice = $economicalMatrice;

        return $this;
    }

    /**
     * Get economicalMatrice
     *
     * @return \NOMatriceBundle\Entity\EconomicalMatrice
     */
    public function getEconomicalMatrice()
    {
        return $this->economicalMatrice;
    }
}
