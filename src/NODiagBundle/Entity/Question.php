<?php

namespace NODiagBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Question
 *
 * @ORM\Table(name="question")
 * @ORM\Entity(repositoryClass="NODiagBundle\Repository\QuestionRepository")
 */
class Question
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
    * @ORM\ManyToOne(targetEntity="NODIagBundle\Entity\QuestionSubFamily")
    * @ORM\JoinColumn(nullable=false)
    */
    private $subFamily;

    /**
     * @var string
     *
     * @ORM\Column(name="question", type="string", length=255, unique=false)
     */
    private $question;

    

    /**
     * @ORM\OneToMany(targetEntity="NODiagBundle\Entity\Answer", mappedBy="question", cascade={"persist"})
    */
    private $answers;


    /**
    * @ORM\OneToMany(targetEntity="NODiagBundle\Entity\ResponseQuestionCompany", mappedBy="question")
    */
    private $responseQuestionsCompany;


    


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
     * Constructor
     */
    public function __construct()
    {
        $this->answers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->responseQuestionsCompany = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set question
     *
     * @param string $question
     *
     * @return Question
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
     * Set subFamily
     *
     * @param \NODIagBundle\Entity\QuestionSubFamily $subFamily
     *
     * @return Question
     */
    public function setSubFamily(\NODIagBundle\Entity\QuestionSubFamily $subFamily)
    {
        $this->subFamily = $subFamily;

        return $this;
    }

    /**
     * Get subFamily
     *
     * @return \NODIagBundle\Entity\QuestionSubFamily
     */
    public function getSubFamily()
    {
        return $this->subFamily;
    }

    /**
     * Add answer
     *
     * @param \NODiagBundle\Entity\Answer $answer
     *
     * @return Question
     */
    public function addAnswer(\NODiagBundle\Entity\Answer $answer)
    {
        $this->answers[] = $answer;

        return $this;
    }

    /**
     * Remove answer
     *
     * @param \NODiagBundle\Entity\Answer $answer
     */
    public function removeAnswer(\NODiagBundle\Entity\Answer $answer)
    {
        $this->answers->removeElement($answer);
    }

    /**
     * Get answers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * Add responseQuestionsCompany
     *
     * @param \NODiagBundle\Entity\ResponseQuestionCompany $responseQuestionsCompany
     *
     * @return Question
     */
    public function addResponseQuestionsCompany(\NODiagBundle\Entity\ResponseQuestionCompany $responseQuestionsCompany)
    {
        $this->responseQuestionsCompany[] = $responseQuestionsCompany;

        return $this;
    }

    /**
     * Remove responseQuestionsCompany
     *
     * @param \NODiagBundle\Entity\ResponseQuestionCompany $responseQuestionsCompany
     */
    public function removeResponseQuestionsCompany(\NODiagBundle\Entity\ResponseQuestionCompany $responseQuestionsCompany)
    {
        $this->responseQuestionsCompany->removeElement($responseQuestionsCompany);
    }

    /**
     * Get responseQuestionsCompany
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getResponseQuestionsCompany()
    {
        return $this->responseQuestionsCompany;
    }
}
