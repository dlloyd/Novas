<?php

namespace CompanyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategMatrice
 *
 * @ORM\Table(name="categ_matrice")
 * @ORM\Entity(repositoryClass="CompanyBundle\Repository\CategMatriceRepository")
 */
class CategMatrice
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}

