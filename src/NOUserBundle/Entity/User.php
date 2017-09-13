<?php

namespace NOUserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="NOUserBundle\Repository\UserRepository")
 */
class User extends BaseUser 
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="CompanyBundle\Entity\Company", inversedBy="moderators")
    */
    private $company;


    /**
    * @var string
    *
    * @ORM\Column(name="company_function", type="string", length=100, nullable=true)
    * 
    */
    private $companyFunction;



    /**
    * @ORM\ManyToMany(targetEntity="NODiagBundle\Entity\QuestionSubFamily", cascade={"persist"})
    */
    private $questionSubFamilies;





    

   

    /**
     * Set companyFunction
     *
     * @param string $companyFunction
     *
     * @return User
     */
    public function setCompanyFunction($companyFunction)
    {
        $this->companyFunction = $companyFunction;

        return $this;
    }

    /**
     * Get companyFunction
     *
     * @return string
     */
    public function getCompanyFunction()
    {
        return $this->companyFunction;
    }

    /**
     * Set company
     *
     * @param \CompanyBundle\Entity\Company $company
     *
     * @return User
     */
    public function setCompany(\CompanyBundle\Entity\Company $company = null)
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
}
