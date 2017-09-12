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
     * @var string
     *
     * @ORM\Column(name="denomination", type="string", length=100, unique=false)
     * @Assert\Length(min=3)
     */
    private $denomination;

    //private $legalStatus;

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

    //private $socialCapital;

    //private $activityBranch;

    //private $address;

    //private $codeNAF;

    //private $matrice;


    /**
    * @ORM\OneToMany(targetEntity="NODiagBundle\Entity\ResponseQuestionCompany", inversedBy="company")
    */
    //private $responseQuestionsCompany;


    /**
     * @ORM\OneToMany(targetEntity="NOUserBundle\Entity\User", mappedBy="company", cascade={"persist"})
    */
    private $moderators;


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
}
