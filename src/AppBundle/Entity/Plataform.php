<?php
/**
 * Created by PhpStorm.
 * User: andresfelipe
 * Date: 10/20/16
 * Time: 8:20 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Class Section
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="plataform")
 * @ORM\Entity
 */
class Plataform
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_plataform",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idPlataform;

    /**
     * @var string
     * @ORM\Column(name="active_period",type="string", length=6, nullable=true, unique=true)
     */
    private $activePeriod;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Period", mappedBy="plataform", cascade={"persist", "remove"})
     */
    private $periods;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->periods = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get idPlataform
     *
     * @return integer
     */
    public function getIdPlataform()
    {
        return $this->idPlataform;
    }

    /**
     * Set activePeriod
     *
     * @param string $activePeriod
     *
     * @return Plataform
     */
    public function setActivePeriod($activePeriod)
    {
        $this->activePeriod = $activePeriod;

        return $this;
    }

    /**
     * Get activePeriod
     *
     * @return string
     */
    public function getActivePeriod()
    {
        return $this->activePeriod;
    }

    /**
     * Add period
     *
     * @param \AppBundle\Entity\Period $period
     *
     * @return Plataform
     */
    public function addPeriod(\AppBundle\Entity\Period $period)
    {
        $this->periods[] = $period;
        $period->setPlataform($this);
        return $this;
    }

    /**
     * Remove period
     *
     * @param \AppBundle\Entity\Period $period
     */
    public function removePeriod(\AppBundle\Entity\Period $period)
    {
        $this->periods->removeElement($period);
    }

    /**
     * Get periods
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPeriods()
    {
        return $this->periods;
    }
}
