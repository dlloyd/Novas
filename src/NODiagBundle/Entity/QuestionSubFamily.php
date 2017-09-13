<?php

namespace NODiagBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QuestionSubFamily
 *
 * @ORM\Table(name="question_sub_family")
 * @ORM\Entity(repositoryClass="NODiagBundle\Repository\QuestionSubFamilyRepository")
 */
class QuestionSubFamily
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
    * @ORM\ManyToOne(targetEntity="NODiagBundle\Entity\QuestionFamily")
    * @ORM\JoinColumn(nullable=false)
    */
    private $family;


    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=false)
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
     * @return QuestionSubFamily
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
     * Set family
     *
     * @param \NODiagBundle\Entity\QuestionFamily $family
     *
     * @return QuestionSubFamily
     */
    public function setFamily(\NODiagBundle\Entity\QuestionFamily $family)
    {
        $this->family = $family;

        return $this;
    }

    /**
     * Get family
     *
     * @return \NODiagBundle\Entity\QuestionFamily
     */
    public function getFamily()
    {
        return $this->family;
    }
}
