<?php

namespace NODiagBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ModeratorAccessRight
 *
 * @ORM\Table(name="moderator_access_right")
 * @ORM\Entity(repositoryClass="NODiagBundle\Repository\ModeratorAccessRightRepository")
 */
class ModeratorAccessRight
{
     /** 
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="NOUserBundle\Entity\User", inversedBy="moderatorAccessRight") 
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false) 
     */
   private $moderator;

   

    /** 
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="NODiagBundle\Entity\QuestionSubFamily", inversedBy="moderatorAccessRight") 
     * @ORM\JoinColumn(name="question_sub_family_id", referencedColumnName="id", nullable=false) 
     */
   private $questionSubFamily;

    /**
     * Set moderator
     *
     * @param \NOUserBundle\Entity\User $moderator
     *
     * @return ModeratorAccessRight
     */
    public function setModerator(\NOUserBundle\Entity\User $moderator)
    {
        $this->moderator = $moderator;

        return $this;
    }

    /**
     * Get moderator
     *
     * @return \NOUserBundle\Entity\User
     */
    public function getModerator()
    {
        return $this->moderator;
    }

    /**
     * Set questionSubFamily
     *
     * @param \NODiagBundle\Entity\QuestionSubFamily $questionSubFamily
     *
     * @return ModeratorAccessRight
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
