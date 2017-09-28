<?php

namespace NODiagBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CompanyQuestionSubFamilyAccess
 *
 * @ORM\Table(name="company_question_sub_family_access")
 * @ORM\Entity(repositoryClass="NODiagBundle\Repository\CompanyQuestionSubFamilyAccessRepository")
 */
class CompanyQuestionSubFamilyAccess
{
    /** 
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="CompanyBundle\Entity\Company", inversedBy="companyQuestionSubFamAccess") 
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id", nullable=false) 
     */
   private $company;

   

   /** 
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="NODiagBundle\Entity\QuestionSubFamily", inversedBy="companyQuestionSubFamAccess") 
     * @ORM\JoinColumn(name="question_sub_fam_id", referencedColumnName="id", nullable=false) 
     */
   private $questionSubFamily;

    /**
     * Set company
     *
     * @param \CompanyBundle\Entity\Company $company
     *
     * @return CompanyQuestionSubFamilyAccess
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
     * Set questionSubFamily
     *
     * @param \NODiagBundle\Entity\QuestionSubFamily $questionSubFamily
     *
     * @return CompanyQuestionSubFamilyAccess
     */
    public function setQuestionSubFamily(\NODiagBundle\Entity\QuestionSubFamily $questionSubFamily)
    {
        $this->questionSubFamily = $questionSubFamily;

        return $this;
    }

    /**
     * Get questionSubFamily
     *
     * @return \NODiagBundle\Entity\QuestionSubFamily
     */
    public function getQuestionSubFamily()
    {
        return $this->questionSubFamily;
    }
}
