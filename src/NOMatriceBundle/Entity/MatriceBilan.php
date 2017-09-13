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
     * @ORM\Column(name="resume_force", type="string", length="1000")
     */
    private $forceResume; 


    /**
     * @var string
     *
     * @ORM\Column(name="resume_weakness", type="string", length="1000")
     */
    private $weaknessResume;

    /**
     * @var string
     *
     * @ORM\Column(name="resume_opportunity", type="string", length="1000")
     */ 
    private $opportunityResume; 
    

    /**
     * @var string
     *
     * @ORM\Column(name="resume_threat", type="string", length="1000")
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


}

