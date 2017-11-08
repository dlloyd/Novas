<?php

namespace NODiagBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Answer
 *
 * @ORM\Table(name="answer")
 * @ORM\Entity(repositoryClass="NODiagBundle\Repository\AnswerRepository")
 */
class Answer
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
     * @ORM\Column(name="answer", type="string", length=255, unique=false)
     */
    private $answer;


    /**
    * @var float
    *
    * @ORM\Column(name="scoring" , type="float", scale=2 )
    * @Assert\Range(
     *      min = 0,
     *      max = 100,
     *      minMessage = "Scoring inférieur à 0",
     *      maxMessage = "Scoring supérieur à 100"
     * )
    */
    private $scoring;



    /**
    * @ORM\ManyToOne(targetEntity="NODiagBundle\Entity\Question", inversedBy="answers")
    * @ORM\JoinColumn(nullable=false)
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
     * Set answer
     *
     * @param string $answer
     *
     * @return Answer
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * Get answer
     *
     * @return string
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Set scoring
     *
     * @param float $scoring
     *
     * @return Answer
     */
    public function setScoring($scoring)
    {
        $this->scoring = $scoring;

        return $this;
    }

    /**
     * Get scoring
     *
     * @return float
     */
    public function getScoring()
    {
        return $this->scoring;
    }

    /**
     * Set question
     *
     * @param \NODIagBundle\Entity\Question $question
     *
     * @return Answer
     */
    public function setQuestion(\NODIagBundle\Entity\Question $question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return \NODIagBundle\Entity\Question
     */
    public function getQuestion()
    {
        return $this->question;
    }
}
