<?php

namespace NODiagBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ResponseQuestionCompany
 *
 * @ORM\Table(name="response_question_company")
 * @ORM\Entity(repositoryClass="NODiagBundle\Repository\ResponseQuestionCompanyRepository")
 */
class ResponseQuestionCompany
{

   /** 
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="CompanyBundle\Entity\Company", inversedBy="responseQuestionsCompany") 
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id", nullable=false) 
     */
   private $company;

   

   /** 
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="NODiagBundle\Entity\Question", inversedBy="responseQuestionsCompany") 
     * @ORM\JoinColumn(name="question_id", referencedColumnName="id", nullable=false) 
     */
   private $question;


   /**
     * @var boolean
     *
     * @ORM\Column(name="is_answered", type="boolean")
     */
   private $isAnswered;


   /**
     * @var \Date
     *
     * @ORM\Column(name="last_modification", type="date",nullable=true)
     */
   private $LastModification;

   /**
     * @var string
     *
     * @ORM\Column(name="username", type="string",nullable=true)
     */
   private $username;

   /**
     * @var int
     *
     * @ORM\Column(name="answers", type="array",nullable=true)
     */
   private $answers;



   /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text",nullable=true)
     */
   private $comment;


   /**
     * @var string
     *
     * @ORM\Column(name="report_comment", type="text",nullable=true)
     */
   private $reportComment;

    /**
     * Set company
     *
     * @param \CompanyBundle\Entity\Company $company
     *
     * @return ResponseQuestionCompany
     */
    public function setCompany(\CompanyBundle\Entity\Company $company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return \CompanyBundle\Entity\Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set question
     *
     * @param \NODiagBundle\Entity\Question $question
     *
     * @return ResponseQuestionCompany
     */
    public function setQuestion(\NODiagBundle\Entity\Question $question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return \NODiagBundle\Entity\Question
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set isAnswered
     *
     * @param boolean $isAnswered
     *
     * @return ResponseQuestionCompany
     */
    public function setIsAnswered($isAnswered)
    {
        $this->isAnswered = $isAnswered;

        return $this;
    }

    /**
     * Get isAnswered
     *
     * @return boolean
     */
    public function getIsAnswered()
    {
        return $this->isAnswered;
    }

    /**
     * Set lastModification
     *
     * @param \DateTime $lastModification
     *
     * @return ResponseQuestionCompany
     */
    public function setLastModification($lastModification)
    {
        $this->LastModification = $lastModification;

        return $this;
    }

    /**
     * Get lastModification
     *
     * @return \DateTime
     */
    public function getLastModification()
    {
        return $this->LastModification;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return ResponseQuestionCompany
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return ResponseQuestionCompany
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set answers
     *
     * @param array $answers
     *
     * @return ResponseQuestionCompany
     */
    public function setAnswers($answers)
    {
        $this->answers = $answers;

        return $this;
    }

    /**
     * Get answers
     *
     * @return array
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * 
     *
     * @return int
     */
    public function getScoring()
    {
        $scoring = 0;
        foreach ($this->getAnswers() as $answ) {
                $scoring += $answ->getScoring();
            }
        return $scoring;
    }
}
