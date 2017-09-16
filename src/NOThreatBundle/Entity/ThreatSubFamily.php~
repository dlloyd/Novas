<?php

namespace NOThreatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ThreatSubFamily
 *
 * @ORM\Table(name="threat_sub_family")
 * @ORM\Entity(repositoryClass="NOThreatBundle\Repository\ThreatSubFamilyRepository")
 */
class ThreatSubFamily
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
    * @ORM\ManyToOne(targetEntity="NOThreatBundle\Entity\ThreatFamily")
    * @ORM\JoinColumn(nullable=false)
    */
    private $threatFamily;


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
     * @return ThreatSubFamily
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

    /**
     * Set threatFamily
     *
     * @param \NOThreatBundle\Entity\ThreatFamily $threatFamily
     *
     * @return ThreatSubFamily
     */
    public function setThreatFamily(\NOThreatBundle\Entity\ThreatFamily $threatFamily)
    {
        $this->threatFamily = $threatFamily;

        return $this;
    }

    /**
     * Get threatFamily
     *
     * @return \NOThreatBundle\Entity\ThreatFamily
     */
    public function getThreatFamily()
    {
        return $this->threatFamily;
    }
}
