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
}

