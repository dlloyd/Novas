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
    * @ORM\OneToMany(targetEntity="NODiagBundle\Entity\ModeratorAccessRight", mappedBy="moderator")
    */
    private $moderatorAccessRight;





    

   

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

   

    /**
     * Add moderatorAccessRight
     *
     * @param \NODiagBundle\Entity\ModeratorAccessRight $moderatorAccessRight
     *
     * @return User
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
}
