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
     * @ORM\ManyToOne(targetEntity="CompanyBundle\Entity\Company", inversedBy="moderators", nullable=false)
    */
    private $company;


    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=10, unique=false)
     * @Assert\Length(min=3)
     */
    private $status;  //admin or employee

    /**
    * @ORM\ManyToMany(targetEntity="NODiagBundle\Entity\QuestionSubFamily", cascade={"persist"})
    */
    private $questionSubFamilies;





    

   
}
