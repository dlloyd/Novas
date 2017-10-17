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
    * @ORM\OneToOne(targetEntity="NOMatriceBundle\Entity\EcologicalMatrice")
    */
    private $ecologicalMatrice;

    /**
    * @ORM\OneToOne(targetEntity="NOMatriceBundle\Entity\TechnologicalMatrice")
    */
    private $technologicalMatrice;

    /**
    * @ORM\OneToOne(targetEntity="NOMatriceBundle\Entity\SocioCulturalMatrice")
    */
    private $socioCulturalMatrice;

    /**
    * @ORM\OneToOne(targetEntity="NOMatriceBundle\Entity\LegalMatrice")
    */
    private $legalMatrice;


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

    /**
     * Set ecologicalMatrice
     *
     * @param \NOMatriceBundle\Entity\EcologicalMatrice $ecologicalMatrice
     *
     * @return Matrice
     */
    public function setEcologicalMatrice(\NOMatriceBundle\Entity\EcologicalMatrice $ecologicalMatrice = null)
    {
        $this->ecologicalMatrice = $ecologicalMatrice;

        return $this;
    }

    /**
     * Get ecologicalMatrice
     *
     * @return \NOMatriceBundle\Entity\EcologicalMatrice
     */
    public function getEcologicalMatrice()
    {
        return $this->ecologicalMatrice;
    }

    /**
     * Set technologicalMatrice
     *
     * @param \NOMatriceBundle\Entity\TechnologicalMatrice $technologicalMatrice
     *
     * @return Matrice
     */
    public function setTechnologicalMatrice(\NOMatriceBundle\Entity\TechnologicalMatrice $technologicalMatrice = null)
    {
        $this->technologicalMatrice = $technologicalMatrice;

        return $this;
    }

    /**
     * Get technologicalMatrice
     *
     * @return \NOMatriceBundle\Entity\TechnologicalMatrice
     */
    public function getTechnologicalMatrice()
    {
        return $this->technologicalMatrice;
    }

    /**
     * Set socioCulturalMatrice
     *
     * @param \NOMatriceBundle\Entity\SocioCulturalMatrice $socioCulturalMatrice
     *
     * @return Matrice
     */
    public function setSocioCulturalMatrice(\NOMatriceBundle\Entity\SocioCulturalMatrice $socioCulturalMatrice = null)
    {
        $this->socioCulturalMatrice = $socioCulturalMatrice;

        return $this;
    }

    /**
     * Get socioCulturalMatrice
     *
     * @return \NOMatriceBundle\Entity\SocioCulturalMatrice
     */
    public function getSocioCulturalMatrice()
    {
        return $this->socioCulturalMatrice;
    }

    /**
     * Set legalMatrice
     *
     * @param \NOMatriceBundle\Entity\LegalMatrice $legalMatrice
     *
     * @return Matrice
     */
    public function setLegalMatrice(\NOMatriceBundle\Entity\LegalMatrice $legalMatrice = null)
    {
        $this->legalMatrice = $legalMatrice;

        return $this;
    }

    /**
     * Get legalMatrice
     *
     * @return \NOMatriceBundle\Entity\LegalMatrice
     */
    public function getLegalMatrice()
    {
        return $this->legalMatrice;
    }
}
