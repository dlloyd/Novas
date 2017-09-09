<?php

namespace CompanyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Matrice
 *
 * @ORM\Table(name="matrice")
 * @ORM\Entity(repositoryClass="CompanyBundle\Repository\MatriceRepository")
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

    //private $politicalMatrice;
    //private $economicalMatrice;
     


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

