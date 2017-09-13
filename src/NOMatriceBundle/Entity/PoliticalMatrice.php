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
