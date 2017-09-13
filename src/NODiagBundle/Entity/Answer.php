<?php

namespace NODiagBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Answer
 *
 * @ORM\Table(name="answer")
 * @ORM\Entity(repositoryClass="NODiagBundle\Repository\AnswerRepository")
 */
class Answer
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
     * @ORM\Column(name="answer", type="string", length=255, unique=false)
     */
    private $answer;


    /**
    * @var float
    *
    * @ORM\Column(name="scoring" , type="float", scale=2 )
    */
    private $scoring;



    /**
    * @ORM\ManyToOne(targetEntity="NODIagBundle\Entity\Question")
    * @ORM\JoinColumn(nullable=false)
    */
    private $question;


    


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
