<?php

namespace NOMatriceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EconomicalMatrice
 *
 * @ORM\Table(name="economical_matrice")
 * @ORM\Entity(repositoryClass="NOMatriceBundle\Repository\EconomicalMatriceRepository")
 */
class EconomicalMatrice
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
}

