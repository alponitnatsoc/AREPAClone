<?php
/**
 * Created by PhpStorm.
 * User: andresfelipe
 * Date: 10/20/16
 * Time: 8:20 PM
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Class Section
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="period")
 * @ORM\Entity
 */
class Period
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_period",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idPeriod;

    /**
     * @var string
     *
     * @ORM\Column(name="code",type="string", length=6, nullable=true, unique=true)
     */
    private $code;

    /**
     * @var Plataform
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Plataform", inversedBy="periods")
     * @ORM\JoinColumn(name="plataform_id", referencedColumnName="id_plataform")
     */
    private $plataform;


    /**
     * @return string
     */
    public function __toString()
    {
        return $this->code;
    }

    /**
     * Get idPeriod
     *
     * @return integer
     */
    public function getIdPeriod()
    {
        return $this->idPeriod;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Period
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set plataform
     *
     * @param \AppBundle\Entity\Plataform $plataform
     *
     * @return Period
     */
    public function setPlataform(\AppBundle\Entity\Plataform $plataform = null)
    {
        $this->plataform = $plataform;

        return $this;
    }

    /**
     * Get plataform
     *
     * @return \AppBundle\Entity\Plataform
     */
    public function getPlataform()
    {
        return $this->plataform;
    }
}
