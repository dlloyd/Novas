<?php

namespace NODiagBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\HttpFoundation\File\File;

use Vich\UploaderBundle\Mapping\Annotation as Vich;



/**
 * Question
 *
 * @ORM\Table(name="question")
 * @ORM\Entity(repositoryClass="NODiagBundle\Repository\QuestionRepository")
 * @Vich\Uploadable
 */
class Question
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
     * @ORM\Column(name="inner_id", type="string")
     */
    private $innerId;


    /**
     * @var \Date
     *
     * @ORM\Column(name="date", type="datetime")
     * @Assert\Date()
     */
    private $date;



    /**
    * @ORM\ManyToOne(targetEntity="NODiagBundle\Entity\QuestionSubFamily",inversedBy="questions")
    * @ORM\JoinColumn(nullable=false)
    */
    private $subFamily;

    /**
     * @var string
     *
     * @ORM\Column(name="question", type="text")
     */
    private $question;

    

    /**
     * @ORM\OneToMany(targetEntity="NODiagBundle\Entity\Answer", mappedBy="question", cascade={"persist"})
    */
    private $answers;


    /**
    * @ORM\OneToMany(targetEntity="NODiagBundle\Entity\ResponseQuestionCompany", mappedBy="question")
    */
    private $responseQuestionsCompany;

    /**
     * @ORM\Column(name="answer_type_is_multiple",type="boolean")
    */
    private $answerTypeIsMultiple;


    /**
     * @var string
     *
     * @ORM\Column(name="pdf_name", type="string", length=255, unique=false, nullable=true)
     */
    private $pdfName;      


    /**
     * @Vich\UploadableField(mapping="pdf_question", fileNameProperty="pdfName")
     * @Assert\File(
     *      maxSize="8M",
     *      mimeTypes={"application/pdf"},
     *      mimeTypesMessage= "Please upload a valid pdf file")
     *
     * @var File
    */
    private $pdfFile;


    /**
     * @var string
     *
     * @ORM\Column(name="image_name", type="string", length=255, unique=false, nullable=true)
     */
    private $imageName;      


    /**
     * @Vich\UploadableField(mapping="image_question", fileNameProperty="imageName")
     * @Assert\File(
     *      maxSize="8M",
     *      mimeTypes={"image/jpeg","image/png","image/pjpeg"},
     *      mimeTypesMessage= "Please upload a valid image (png,jpeg)")
     *
     * @var File
    */
    private $imageFile;

    /**
     * @var string
     *
     * @ORM\Column(name="youtube_link", type="string", length=255, unique=false, nullable=true)
     */
    private $videoYoutubeLink;


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
        $this->answers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->responseQuestionsCompany = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set question
     *
     * @param string $question
     *
     * @return Question
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set subFamily
     *
     * @param \NODIagBundle\Entity\QuestionSubFamily $subFamily
     *
     * @return Question
     */
    public function setSubFamily(\NODIagBundle\Entity\QuestionSubFamily $subFamily)
    {
        $this->subFamily = $subFamily;

        return $this;
    }

    /**
     * Get subFamily
     *
     * @return \NODIagBundle\Entity\QuestionSubFamily
     */
    public function getSubFamily()
    {
        return $this->subFamily;
    }

    /**
     * Add answer
     *
     * @param \NODiagBundle\Entity\Answer $answer
     *
     * @return Question
     */
    public function addAnswer(\NODiagBundle\Entity\Answer $answer)
    {
        $this->answers[] = $answer;

        return $this;
    }

    /**
     * Remove answer
     *
     * @param \NODiagBundle\Entity\Answer $answer
     */
    public function removeAnswer(\NODiagBundle\Entity\Answer $answer)
    {
        $this->answers->removeElement($answer);
    }

    /**
     * Get answers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * Add responseQuestionsCompany
     *
     * @param \NODiagBundle\Entity\ResponseQuestionCompany $responseQuestionsCompany
     *
     * @return Question
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
     * Set answerTypeIsMultiple
     *
     * @param boolean $answerTypeIsMultiple
     *
     * @return Question
     */
    public function setAnswerTypeIsMultiple($answerTypeIsMultiple)
    {
        $this->answerTypeIsMultiple = $answerTypeIsMultiple;

        return $this;
    }

    /**
     * Get answerTypeIsMultiple
     *
     * @return boolean
     */
    public function getAnswerTypeIsMultiple()
    {
        return $this->answerTypeIsMultiple;
    }

    /**
     * Set innerId
     *
     * @param string $innerId
     *
     * @return Question
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
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $pdf
     *
     * @return Question
    */
    public function setPdfFile(File $pdf = null)
    {
        $this->pdfFile = $pdf;

        if($pdf){
            $this->date = new\DateTimeImmutable();
        }
        return $this;
    }


    /**
     * @return File|null
    */
    public function getPdfFile()
    {
        return $this->pdfFile;
    }


    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $img
     *
     * @return Question
    */
    public function setImageFile(File $img = null)
    {
        $this->imageFile = $img;

        if($img){
            $this->date = new\DateTimeImmutable();
        }
        return $this;
    }


    /**
     * @return File|null
    */
    public function getImageFile()
    {
        return $this->imageFile;
    }




    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Question
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set pdfName
     *
     * @param string $pdfName
     *
     * @return Question
     */
    public function setPdfName($pdfName)
    {
        $this->pdfName = $pdfName;

        return $this;
    }

    /**
     * Get pdfName
     *
     * @return string
     */
    public function getPdfName()
    {
        return $this->pdfName;
    }

    /**
     * Set imageName
     *
     * @param string $imageName
     *
     * @return Question
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * Get imageName
     *
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
    }


    /**
    * @Assert\Callback
    */
    public function validate(ExecutionContextInterface $context){
        $scoring = 0;
        foreach ($this->answers as $answer) {
            $scoring += $answer->getScoring(); 
        }

        if( $scoring > 100 && $this->getAnswerTypeIsMultiple() ){
            $context->buildViolation('scoring total supérieur à 100')
                ->atPath('answers')
                ->addViolation();
        }
    }

    /**
     * Set videoYoutubeLink
     *
     * @param string $videoYoutubeLink
     *
     * @return Question
     */
    public function setVideoYoutubeLink($videoYoutubeLink)
    {
        $this->videoYoutubeLink = $videoYoutubeLink;

        return $this;
    }

    /**
     * Get videoYoutubeLink
     *
     * @return string
     */
    public function getVideoYoutubeLink()
    {
        return $this->videoYoutubeLink;
    }
}
