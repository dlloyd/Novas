<?php

namespace NOMatriceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PoliticalMatrice
 *
 * @ORM\Table(name="political_matrice")
 * @ORM\Entity(repositoryClass="NOMatriceBundle\Repository\PoliticalMatriceRepository")
 */
class PoliticalMatrice
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
    * @ORM\OneToOne(targetEntity="NOMatriceBundle\Entity\MatriceBilan")
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
     * @return PoliticalMatrice
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
