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
    * @ORM\ManyToOne(targetEntity="NODiagBundle\Entity\QuestionFamily",inversedBy="subFamilies")
    * @ORM\JoinColumn(nullable=false)
    */
    private $family;

    /**
    * @ORM\OneToMany(targetEntity="NODiagBundle\Entity\Question",mappedBy="subFamily")
    */
    private $questions;


    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=false)
     */
    private $name;


    /**
    * @ORM\OneToMany(targetEntity="NODiagBundle\Entity\ModeratorAccessRight", mappedBy="questionSubFamily")
    */
    private $moderatorAccessRight;

    /**
    * @ORM\OneToMany(targetEntity="NODiagBundle\Entity\CompanyQuestionSubFamilyAccess", mappedBy="questionSubFamily")
    */
    private $companyQuestionSubFamAccess;


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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->moderatorAccessRight = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add moderatorAccessRight
     *
     * @param \NODiagBundle\Entity\ModeratorAccessRight $moderatorAccessRight
     *
     * @return QuestionSubFamily
     */
    public function addModeratorAccessRight(\NODiagBundle\Entity\ModeratorAccessRight $moderatorAccessRight)
    {
        $this->moderatorAccessRight[] = $moderatorAccessRight;

        return $this;
    }

    /**
     * Remove moderatorAccessRight
     *
     * @param \NODiagBundle\Entity\ModeratorAccessRight $moderatorAccessRight
     */
    public function removeModeratorAccessRight(\NODiagBundle\Entity\ModeratorAccessRight $moderatorAccessRight)
    {
        $this->moderatorAccessRight->removeElement($moderatorAccessRight);
    }

    /**
     * Get moderatorAccessRight
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getModeratorAccessRight()
    {
        return $this->moderatorAccessRight;
    }

    /**
     * Add companyQuestionSubFamAccess
     *
     * @param \NODiagBundle\Entity\CompanyQuestionSubFamilyAccess $companyQuestionSubFamAccess
     *
     * @return QuestionSubFamily
     */
    public function addCompanyQuestionSubFamAccess(\NODiagBundle\Entity\CompanyQuestionSubFamilyAccess $companyQuestionSubFamAccess)
    {
        $this->companyQuestionSubFamAccess[] = $companyQuestionSubFamAccess;

        return $this;
    }

    /**
     * Remove companyQuestionSubFamAccess
     *
     * @param \NODiagBundle\Entity\CompanyQuestionSubFamilyAccess $companyQuestionSubFamAccess
     */
    public function removeCompanyQuestionSubFamAccess(\NODiagBundle\Entity\CompanyQuestionSubFamilyAccess $companyQuestionSubFamAccess)
    {
        $this->companyQuestionSubFamAccess->removeElement($companyQuestionSubFamAccess);
    }

    /**
     * Get companyQuestionSubFamAccess
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCompanyQuestionSubFamAccess()
    {
        return $this->companyQuestionSubFamAccess;
    }

    /**
     * Add question
     *
     * @param \NODiagBundle\Entity\Question $question
     *
     * @return QuestionSubFamily
     */
    public function addQuestion(\NODiagBundle\Entity\Question $question)
    {
        $this->questions[] = $question;

        return $this;
    }

    /**
     * Remove question
     *
     * @param \NODiagBundle\Entity\Question $question
     */
    public function removeQuestion(\NODiagBundle\Entity\Question $question)
    {
        $this->questions->removeElement($question);
    }

    /**
     * Get questions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getQuestions()
    {
        return $this->questions;
    }


   
}
