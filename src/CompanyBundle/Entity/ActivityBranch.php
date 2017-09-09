<?php

namespace CompanyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ActivityBranch
 *
 * @ORM\Table(name="activity_branch")
 * @ORM\Entity(repositoryClass="CompanyBundle\Repository\ActivityBranchRepository")
 */
class ActivityBranch
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    //private $name;


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

