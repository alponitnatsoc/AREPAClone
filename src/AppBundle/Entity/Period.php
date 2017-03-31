<?php
/**
 * Created by PhpStorm.
 * User: andresfelipe
 * Date: 10/20/16
 * Time: 8:20 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\NotBlank(message="period.code.not_blank")
     * @Assert\Type(type="numeric",message="period.code.not_numeric")
     */
    private $code;

    /**
     * @var Platform
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Platform", inversedBy="periods")
     * @ORM\JoinColumn(name="platform_id", referencedColumnName="id_platform")
     */
    private $platform;


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
     * Set platform
     *
     * @param \AppBundle\Entity\Platform $platform
     *
     * @return Period
     */
    public function setPlatform(\AppBundle\Entity\Platform $platform = null)
    {
        $this->platform = $platform;

        return $this;
    }

    /**
     * Get plataform
     *
     * @return \AppBundle\Entity\Platform
     */
    public function getPlatform()
    {
        return $this->platform;
    }
}
