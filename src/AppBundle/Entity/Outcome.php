<?php
/**
 * Created by PhpStorm.
 * User: erikaxu
 * Date: 14/09/16
 * Time: 06:57 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Class Outcome
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="outcome",
 *     uniqueConstraints={
 *          @UniqueConstraint(
 *              name="personStudentUnique", columns={"name_outcome"}
 *          )
 *     })
 * @ORM\Entity
 */
class Outcome
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id_student",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idOutcome;

    /**
     * @var string
     *
     * @ORM\Column(name="name_outcome",type="string", length=10)
     */
    private $nameOutcome;

    /**
     * @var string
     *
     * @ORM\Column(name="description_outcome",type="string", length=300)
     */
    private $descriptionOutcome;

    /**
     * Get idOutcome
     *
     * @return integer
     */
    public function getIdOutcome()
    {
        return $this->idOutcome;
    }

    /**
     * Set nameOutcome
     *
     * @param string $nameOutcome
     *
     * @return Outcome
     */
    public function setNameOutcome($nameOutcome)
    {
        $this->nameOutcome = $nameOutcome;

        return $this;
    }

    /**
     * Get nameOutcome
     *
     * @return string
     */
    public function getNameOutcome()
    {
        return $this->nameOutcome;
    }

    /**
     * Set descriptionOutcome
     *
     * @param string $descriptionOutcome
     *
     * @return Outcome
     */
    public function setDescriptionOutcome($descriptionOutcome)
    {
        $this->descriptionOutcome = $descriptionOutcome;

        return $this;
    }

    /**
     * Get descriptionOutcome
     *
     * @return string
     */
    public function getDescriptionOutcome()
    {
        return $this->descriptionOutcome;
    }
}
