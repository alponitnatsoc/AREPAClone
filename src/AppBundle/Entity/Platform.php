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
 * Class Platform
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="platform")
 * @ORM\Entity
 */
class Platform
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_platform",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idPlatform;

    /**
     * @var string
     * @ORM\Column(name="active_period",type="string", length=6, nullable=true, unique=true)
     */
    private $activePeriod;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Period", mappedBy="platform", cascade={"persist", "remove"})
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
    public function getIdPlatform()
    {
        return $this->idPlatform;
    }

    /**
     * Set activePeriod
     *
     * @param string $activePeriod
     *
     * @return Platform
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
     * @return Platform
     */
    public function addPeriod(\AppBundle\Entity\Period $period)
    {
        $this->periods[] = $period;
        $period->setPlatform($this);
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
