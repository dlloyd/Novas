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
    * @ORM\OneToOne(targetEntity="NODIagBundle\Entity\QuestionFamily")
    * @ORM\JoinColumn(nullable=false)
    */
    private $family;


    /**
     * @var string
     *
     * @ORM\Column(name="question", type="string", length=255, unique=false)
     */
    private $question;


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
     * Set question
     *
     * @param string $question
     *
     * @return QuestionSubFamily
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set family
     *
     * @param \NODIagBundle\Entity\QuestionFamily $family
     *
     * @return QuestionSubFamily
     */
    public function setFamily(\NODIagBundle\Entity\QuestionFamily $family)
    {
        $this->family = $family;

        return $this;
    }

    /**
     * Get family
     *
     * @return \NODIagBundle\Entity\QuestionFamily
     */
    public function getFamily()
    {
        return $this->family;
    }
}
