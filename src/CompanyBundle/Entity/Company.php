<?php

namespace CompanyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Company
 *
 * @ORM\Table(name="company")
 * @ORM\Entity(repositoryClass="CompanyBundle\Repository\CompanyRepository")
 */
class Company
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
     * @ORM\Column(name="inner_id", type="string", length=50, unique=true)
     * @Assert\Length(min=3)
     */
    private $innerId;


    /**
     * @var int
     *
     * @ORM\Column(name="administrator_id", type="integer")
     */
    private $administratorId;


    /**
     * @var string
     *
     * @ORM\Column(name="denomination", type="string", length=100, unique=false)
     * @Assert\Length(min=3)
     */
    private $denomination;

    



    /**
     * @ORM\ManyToOne(targetEntity="CompanyBundle\Entity\LegalStatus")
    */
    private $legalStatus;

    /**
     * @var int
     *
     * @ORM\Column(name="nbr_employees", type="integer")
     */
    private $employeesNumber;

    /**
     * @var \Date
     *
     * @ORM\Column(name="date_begin", type="date")
     */
    private $activityBeginDate;



    /**
     * @var string
     *
     * @ORM\Column(name="social_capital", type="string", length=20, unique=false,nullable=true)
     */
    private $socialCapital;


    /**
     * @ORM\ManyToOne(targetEntity="CompanyBundle\Entity\ActivityBranch")
    */
    private $activityBranch;


    /**
     * @ORM\OneToOne(targetEntity="CompanyBundle\Entity\Address")
    */
    private $address;

    

    /**
     * @ORM\ManyToOne(targetEntity="CompanyBundle\Entity\CodeNAF")
    */
    private $codeNAF;

    /**
    * @ORM\OneToOne(targetEntity="NOMatriceBundle\Entity\Matrice",cascade={"persist"})
    */
    private $matrice;


    /**
     * @ORM\OneToMany(targetEntity="NOUserBundle\Entity\User", mappedBy="company", cascade={"persist"})
    */
    private $moderators;


    /**
    * @ORM\OneToMany(targetEntity="NODiagBundle\Entity\ResponseQuestionCompany", mappedBy="company")
    */
    private $responseQuestionsCompany;



    /**
    * @ORM\OneToMany(targetEntity="NODiagBundle\Entity\CompanyQuestionSubFamilyAccess", mappedBy="company")
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
     * Constructor
     */
    public function __construct()
    {
        $this->moderators = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set innerId
     *
     * @param string $innerId
     *
     * @return Company
     */
    public function setInnerId($innerId)
    {
        $this->innerId = $innerId;

        return $this;
    }

    /**
     * Get innerId
     *
     * @return string
     */
    public function getInnerId()
    {
        return $this->innerId;
    }

    /**
     * Set denomination
     *
     * @param string $denomination
     *
     * @return Company
     */
    public function setDenomination($denomination)
    {
        $this->denomination = $denomination;

        return $this;
    }

    /**
     * Get denomination
     *
     * @return string
     */
    public function getDenomination()
    {
        return $this->denomination;
    }

    /**
     * Set employeesNumber
     *
     * @param integer $employeesNumber
     *
     * @return Company
     */
    public function setEmployeesNumber($employeesNumber)
    {
        $this->employeesNumber = $employeesNumber;

        return $this;
    }

    /**
     * Get employeesNumber
     *
     * @return integer
     */
    public function getEmployeesNumber()
    {
        return $this->employeesNumber;
    }

    /**
     * Set activityBeginDate
     *
     * @param \DateTime $activityBeginDate
     *
     * @return Company
     */
    public function setActivityBeginDate($activityBeginDate)
    {
        $this->activityBeginDate = $activityBeginDate;

        return $this;
    }

    /**
     * Get activityBeginDate
     *
     * @return string
     */
    public function getActivityBeginDate()
    {
        if($this->activityBeginDate !=null)
            return $this->activityBeginDate->format('d/m/Y');
        else
            return $this->activityBeginDate;
    }

    /**
     * Add moderator
     *
     * @param \NOUserBundle\Entity\User $moderator
     *
     * @return Company
     */
    public function addModerator(\NOUserBundle\Entity\User $moderator)
    {
        $this->moderators[] = $moderator;

        return $this;
    }

    /**
     * Remove moderator
     *
     * @param \NOUserBundle\Entity\User $moderator
     */
    public function removeModerator(\NOUserBundle\Entity\User $moderator)
    {
        $this->moderators->removeElement($moderator);
    }

    /**
     * Get moderators
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getModerators()
    {
        return $this->moderators;
    }

    /**
     * Set socialCapital
     *
     * @param string $socialCapital
     *
     * @return Company
     */
    public function setSocialCapital($socialCapital)
    {
        $this->socialCapital = $socialCapital;

        return $this;
    }

    /**
     * Get socialCapital
     *
     * @return string
     */
    public function getSocialCapital()
    {
        return $this->socialCapital;
    }

    /**
     * Set legalStatus
     *
     * @param \CompanyBundle\Entity\LegalStatus $legalStatus
     *
     * @return Company
     */
    public function setLegalStatus(\CompanyBundle\Entity\LegalStatus $legalStatus = null)
    {
        $this->legalStatus = $legalStatus;

        return $this;
    }

    /**
     * Get legalStatus
     *
     * @return \CompanyBundle\Entity\LegalStatus
     */
    public function getLegalStatus()
    {
        return $this->legalStatus;
    }

    /**
     * Set activityBranch
     *
     * @param \CompanyBundle\Entity\ActivityBranch $activityBranch
     *
     * @return Company
     */
    public function setActivityBranch(\CompanyBundle\Entity\ActivityBranch $activityBranch = null)
    {
        $this->activityBranch = $activityBranch;

        return $this;
    }

    /**
     * Get activityBranch
     *
     * @return \CompanyBundle\Entity\ActivityBranch
     */
    public function getActivityBranch()
    {
        return $this->activityBranch;
    }

    /**
     * Set address
     *
     * @param \CompanyBundle\Entity\Address $address
     *
     * @return Company
     */
    public function setAddress(\CompanyBundle\Entity\Address $address = null)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return \CompanyBundle\Entity\Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set codeNAF
     *
     * @param \CompanyBundle\Entity\CodeNAF $codeNAF
     *
     * @return Company
     */
    public function setCodeNAF(\CompanyBundle\Entity\CodeNAF $codeNAF = null)
    {
        $this->codeNAF = $codeNAF;

        return $this;
    }

    /**
     * Get codeNAF
     *
     * @return \CompanyBundle\Entity\CodeNAF
     */
    public function getCodeNAF()
    {
        return $this->codeNAF;
    }

    /**
     * Set matrice
     *
     * @param \NOMatriceBundle\Entity\Matrice $matrice
     *
     * @return Company
     */
    public function setMatrice(\NOMatriceBundle\Entity\Matrice $matrice = null)
    {
        $this->matrice = $matrice;

        return $this;
    }

    /**
     * Get matrice
     *
     * @return \NOMatriceBundle\Entity\Matrice
     */
    public function getMatrice()
    {
        return $this->matrice;
    }

    /**
     * Add responseQuestionsCompany
     *
     * @param \NODiagBundle\Entity\ResponseQuestionCompany $responseQuestionsCompany
     *
     * @return Company
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

    /**
     * Add companyQuestionSubFamAccess
     *
     * @param \NODiagBundle\Entity\CompanyQuestionSubFamilyAccess $companyQuestionSubFamAccess
     *
     * @return Company
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
     * Set administratorId
     *
     * @param integer $administratorId
     *
     * @return Company
     */
    public function setAdministratorId($administratorId)
    {
        $this->administratorId = $administratorId;

        return $this;
    }

    /**
     * Get administratorId
     *
     * @return integer
     */
    public function getAdministratorId()
    {
        return $this->administratorId;
    }
}
