<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 22/02/17
 * Time: 10:28 AM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Person;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Class PersonHasRole
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="person_has_role",
 *     uniqueConstraints={
 *          @UniqueConstraint(
 *              name="unique_person_has_role", columns={"person_id","target_entity","target_id"}
 *          )
 * })
 * @ORM\Entity
 */
class PersonHasRole
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_person_has_role",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idPersonHasRole;

    /**
     * @var Person
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Person",inversedBy="roles", cascade={"persist"})
     * @ORM\JoinColumn(name="person_id",referencedColumnName="id_person")
     */
    private $person;

    /**
     * @var string
     * @ORM\Column(name="target_entity", type="string", nullable=false)
     */
    private $targetEntity;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Student",mappedBy="personRole", cascade={"persist","remove"})
     * @ORM\Column(name="student_id")
     */
    private $student;

    /**
     * @var integer
     * @ORM\Column(name="target_id", type="integer", nullable=false)
     */
    private $targetId;


    /**
     * Get idPersonHasRole
     *
     * @return integer
     */
    public function getIdPersonHasRole()
    {
        return $this->idPersonHasRole;
    }

    /**
     * Set targetEntity
     *
     * @param string $targetEntity
     *
     * @return PersonHasRole
     */
    public function setTargetEntity($targetEntity)
    {
        $this->targetEntity = $targetEntity;

        return $this;
    }

    /**
     * Get targetEntity
     *
     * @return string
     */
    public function getTargetEntity()
    {
        return $this->targetEntity;
    }

    /**
     * Set targetId
     *
     * @param integer $targetId
     *
     * @return PersonHasRole
     */
    public function setTargetId($targetId)
    {
        $this->targetId = $targetId;

        return $this;
    }

    /**
     * Get targetId
     *
     * @return integer
     */
    public function getTargetId()
    {
        return $this->targetId;
    }

    /**
     * Set person
     *
     * @param \AppBundle\Entity\Person $person
     *
     * @return PersonHasRole
     */
    public function setPerson(Person $person = null)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Get person
     *
     * @return \AppBundle\Entity\Person
     */
    public function getPerson()
    {
        return $this->person;
    }
}
