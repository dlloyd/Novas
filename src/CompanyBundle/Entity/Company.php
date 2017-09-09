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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
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
    private $responseQuestionsCompany;


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
}

