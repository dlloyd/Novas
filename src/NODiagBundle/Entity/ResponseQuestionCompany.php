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
     * @ORM\ManyToOne(targetEntity="CompanyBundle\Entity\Company", inversedBy="companyQuestion") 
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id", nullable=false) 
     */
   private $company;

   

    /** 
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="NODiagBundle\Entity\Question", inversedBy="companyQuestion") 
     * @ORM\JoinColumn(name="question_id", referencedColumnName="id", nullable=false) 
     */
   private $question;




   private $LastModification;

   private $username;

   private $answerId;

   private $comment;

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
}
