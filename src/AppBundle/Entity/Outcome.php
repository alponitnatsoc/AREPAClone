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
     * @var float
     *
     * @ORM\Column(name="exalumns_outcome_value",type="float")
     */
    private $exalumnsOutcomeValue;

    /**
     * @var float
     *
     * @ORM\Column(name="internal_outcome_value",type="float")
     */
    private $internalOutcomeValue;

    /**
     * @var float
     *
     * @ORM\Column(name="exalumns_porcentage_value",type="float")
     */
    private $exalumnsPorcentageValue;



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

    /**
     * Set exalumnsOutcomeValue
     *
     * @param float $exalumnsOutcomeValue
     *
     * @return Outcome
     */
    public function setExalumnsOutcomeValue($exalumnsOutcomeValue)
    {
        $this->exalumnsOutcomeValue = $exalumnsOutcomeValue;

        return $this;
    }

    /**
     * Get exalumnsOutcomeValue
     *
     * @return float
     */
    public function getExalumnsOutcomeValue()
    {
        return $this->exalumnsOutcomeValue;
    }

    /**
     * Set internalOutcomeValue
     *
     * @param float $internalOutcomeValue
     *
     * @return Outcome
     */
    public function setInternalOutcomeValue($internalOutcomeValue)
    {
        $this->internalOutcomeValue = $internalOutcomeValue;

        return $this;
    }

    /**
     * Get internalOutcomeValue
     *
     * @return float
     */
    public function getInternalOutcomeValue()
    {
        return $this->internalOutcomeValue;
    }

    /**
     * Set exalumnsPorcentageValue
     *
     * @param float $exalumnsPorcentageValue
     *
     * @return Outcome
     */
    public function setExalumnsPorcentageValue($exalumnsPorcentageValue)
    {
        $this->exalumnsPorcentageValue = $exalumnsPorcentageValue;

        return $this;
    }

    /**
     * Get exalumnsPorcentageValue
     *
     * @return float
     */
    public function getExalumnsPorcentageValue()
    {
        return $this->exalumnsPorcentageValue;
    }
}
