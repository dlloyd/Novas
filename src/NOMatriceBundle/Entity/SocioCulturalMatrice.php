<?php

namespace NOMatriceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SocioCulturalMatrice
 *
 * @ORM\Table(name="socio_cultural_matrice")
 * @ORM\Entity(repositoryClass="NOMatriceBundle\Repository\SocioCulturalMatriceRepository")
 */
class SocioCulturalMatrice
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
    * @ORM\OneToOne(targetEntity="NOMatriceBundle\Entity\MatriceBilan", cascade={"persist"})
    */
    private $matriceBilan;


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
     * Set matriceBilan
     *
     * @param \NOMatriceBundle\Entity\MatriceBilan $matriceBilan
     *
     * @return EconomicalMatrice
     */
    public function setMatriceBilan(\NOMatriceBundle\Entity\MatriceBilan $matriceBilan = null)
    {
        $this->matriceBilan = $matriceBilan;

        return $this;
    }

    /**
     * Get matriceBilan
     *
     * @return \NOMatriceBundle\Entity\MatriceBilan
     */
    public function getMatriceBilan()
    {
        return $this->matriceBilan;
    }
}

