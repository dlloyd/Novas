<?php

namespace NODiagBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QuestionFamily
 *
 * @ORM\Table(name="question_family")
 * @ORM\Entity(repositoryClass="NODiagBundle\Repository\QuestionFamilyRepository")
 */
class QuestionFamily
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
     * @ORM\Column(name="name", type="string", length=255, unique=false)
     */
    private $name;

    /**
    * @ORM\OneToMany(targetEntity="NODiagBundle\Entity\QuestionSubFamily",mappedBy="family")
    */
    private $subFamilies;


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
     * @return QuestionFamily
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
     * Constructor
     */
    public function __construct()
    {
        $this->subFamilies = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add subFamily
     *
     * @param \NODiagBundle\Entity\QuestionSubFamily $subFamily
     *
     * @return QuestionFamily
     */
    public function addSubFamily(\NODiagBundle\Entity\QuestionSubFamily $subFamily)
    {
        $this->subFamilies[] = $subFamily;

        return $this;
    }

    /**
     * Remove subFamily
     *
     * @param \NODiagBundle\Entity\QuestionSubFamily $subFamily
     */
    public function removeSubFamily(\NODiagBundle\Entity\QuestionSubFamily $subFamily)
    {
        $this->subFamilies->removeElement($subFamily);
    }

    /**
     * Get subFamilies
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubFamilies()
    {
        return $this->subFamilies;
    }
}
