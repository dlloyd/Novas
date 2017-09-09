<?php

namespace CompanyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeMatrice
 *
 * @ORM\Table(name="type_matrice")
 * @ORM\Entity(repositoryClass="CompanyBundle\Repository\TypeMatriceRepository")
 */
class TypeMatrice
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    //private $force;
    //private $weakness;
    //private $opportunity;
    //private $threat;
    //private $forceResume; 
    //private $weaknessResume; 
    //private $opportunityResume; 
    //private $threatResume;




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

