<?php

namespace CompanyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CodeNAF
 *
 * @ORM\Table(name="code_n_a_f")
 * @ORM\Entity(repositoryClass="CompanyBundle\Repository\CodeNAFRepository")
 */
class CodeNAF
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
     * @ORM\Column(name="name", type="string", length="60")
     */
    private $name;


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

