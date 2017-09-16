<?php

namespace NOThreatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EventThreat
 *
 * @ORM\Table(name="event_threat")
 * @ORM\Entity(repositoryClass="NOThreatBundle\Repository\EventThreatRepository")
 */
class EventThreat
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
     * @ORM\Column(name="name", type="text")
     */
    private $definition;



    /**
    * @ORM\ManyToOne(targetEntity="NOThreatBundle\Entity\ThreatSubFamily")
    * @ORM\JoinColumn(nullable=false)
    */
    private $threatSubFamily;


    /**
     * @var string
     *
     * @ORM\Column(name="causes", type="text")
     */
    private $causes;


    /**
     * @var string
     *
     * @ORM\Column(name="consequences", type="text")
     */
    private $consequences;


    /**
     * @var string
     *
     * @ORM\Column(name="cost_threat", type="text")
     */
    private $costThreat;


    /**
     * @var string
     *
     * @ORM\Column(name="actions", type="text")
     */
    private $actions;



    /**
     * @var string
     *
     * @ORM\Column(name="pilotage", type="text")
     */
    private $pilotage;


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
     * Set definition
     *
     * @param string $definition
     *
     * @return EventThreat
     */
    public function setDefinition($definition)
    {
        $this->definition = $definition;

        return $this;
    }

    /**
     * Get definition
     *
     * @return string
     */
    public function getDefinition()
    {
        return $this->definition;
    }

    /**
     * Set causes
     *
     * @param string $causes
     *
     * @return EventThreat
     */
    public function setCauses($causes)
    {
        $this->causes = $causes;

        return $this;
    }

    /**
     * Get causes
     *
     * @return string
     */
    public function getCauses()
    {
        return $this->causes;
    }

    /**
     * Set consequences
     *
     * @param string $consequences
     *
     * @return EventThreat
     */
    public function setConsequences($consequences)
    {
        $this->consequences = $consequences;

        return $this;
    }

    /**
     * Get consequences
     *
     * @return string
     */
    public function getConsequences()
    {
        return $this->consequences;
    }

    /**
     * Set costThreat
     *
     * @param string $costThreat
     *
     * @return EventThreat
     */
    public function setCostThreat($costThreat)
    {
        $this->costThreat = $costThreat;

        return $this;
    }

    /**
     * Get costThreat
     *
     * @return string
     */
    public function getCostThreat()
    {
        return $this->costThreat;
    }

    /**
     * Set actions
     *
     * @param string $actions
     *
     * @return EventThreat
     */
    public function setActions($actions)
    {
        $this->actions = $actions;

        return $this;
    }

    /**
     * Get actions
     *
     * @return string
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * Set pilotage
     *
     * @param string $pilotage
     *
     * @return EventThreat
     */
    public function setPilotage($pilotage)
    {
        $this->pilotage = $pilotage;

        return $this;
    }

    /**
     * Get pilotage
     *
     * @return string
     */
    public function getPilotage()
    {
        return $this->pilotage;
    }

    /**
     * Set threatSubFamily
     *
     * @param \NOThreatBundle\Entity\ThreatSubFamily $threatSubFamily
     *
     * @return EventThreat
     */
    public function setThreatSubFamily(\NOThreatBundle\Entity\ThreatSubFamily $threatSubFamily)
    {
        $this->threatSubFamily = $threatSubFamily;

        return $this;
    }

    /**
     * Get threatSubFamily
     *
     * @return \NOThreatBundle\Entity\ThreatSubFamily
     */
    public function getThreatSubFamily()
    {
        return $this->threatSubFamily;
    }
}
