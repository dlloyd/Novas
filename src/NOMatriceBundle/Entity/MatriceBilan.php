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
     * @ORM\Column(name="force", type="text")
     */
    private $force;


    /**
     * @var string
     *
     * @ORM\Column(name="weakness", type="text")
     */
    private $weakness;


    /**
     * @var string
     *
     * @ORM\Column(name="opportunity", type="text")
     */
    private $opportunity;


    /**
     * @var string
     *
     * @ORM\Column(name="threat", type="text")
     */
    private $threat;


    /**
     * @var string
     *
     * @ORM\Column(name="resume_force", type="string", length=1000)
     */
    private $forceResume; 


    /**
     * @var string
     *
     * @ORM\Column(name="resume_weakness", type="string", length=1000)
     */
    private $weaknessResume;

    /**
     * @var string
     *
     * @ORM\Column(name="resume_opportunity", type="string", length=1000)
     */ 
    private $opportunityResume; 
    

    /**
     * @var string
     *
     * @ORM\Column(name="resume_threat", type="string", length=1000)
     */
    private $threatResume;


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

    /**
     * Set forceResume
     *
     * @param string $forceResume
     *
     * @return MatriceBilan
     */
    public function setForceResume($forceResume)
    {
        $this->forceResume = $forceResume;

        return $this;
    }

    /**
     * Get forceResume
     *
     * @return string
     */
    public function getForceResume()
    {
        return $this->forceResume;
    }

    /**
     * Set weaknessResume
     *
     * @param string $weaknessResume
     *
     * @return MatriceBilan
     */
    public function setWeaknessResume($weaknessResume)
    {
        $this->weaknessResume = $weaknessResume;

        return $this;
    }

    /**
     * Get weaknessResume
     *
     * @return string
     */
    public function getWeaknessResume()
    {
        return $this->weaknessResume;
    }

    /**
     * Set opportunityResume
     *
     * @param string $opportunityResume
     *
     * @return MatriceBilan
     */
    public function setOpportunityResume($opportunityResume)
    {
        $this->opportunityResume = $opportunityResume;

        return $this;
    }

    /**
     * Get opportunityResume
     *
     * @return string
     */
    public function getOpportunityResume()
    {
        return $this->opportunityResume;
    }

    /**
     * Set threatResume
     *
     * @param string $threatResume
     *
     * @return MatriceBilan
     */
    public function setThreatResume($threatResume)
    {
        $this->threatResume = $threatResume;

        return $this;
    }

    /**
     * Get threatResume
     *
     * @return string
     */
    public function getThreatResume()
    {
        return $this->threatResume;
    }
}
