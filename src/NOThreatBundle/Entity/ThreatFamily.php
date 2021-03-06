<?php

namespace NOThreatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ThreatFamily
 *
 * @ORM\Table(name="threat_family")
 * @ORM\Entity(repositoryClass="NOThreatBundle\Repository\ThreatFamilyRepository")
 */
class ThreatFamily
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
    * @ORM\Column(name="name", type="string",length=100)
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

    /**
     * Set name
     *
     * @param string $name
     *
     * @return ThreatFamily
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
