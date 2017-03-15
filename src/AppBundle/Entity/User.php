<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 1/10/16
 * Time: 10:31 AM
 */

namespace AppBundle\Entity;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class User
 * @package AppBundle\Entity
 * @ORM\Table(name="user")
 * @ORM\Entity()
 */
class User extends BaseUser
{
    /**
     * @var integer
     * @ORM\Column(name="id",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Person", mappedBy="user", cascade={"persist"})
     * @ORM\JoinColumn(name="person_id_person", referencedColumnName="id_person", unique=TRUE)
     */
    private $personPerson;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set personPerson
     *
     * @param \AppBundle\Entity\Person $personPerson
     *
     * @return User
     */
    public function setPersonPerson(\AppBundle\Entity\Person $personPerson = null)
    {
        $this->personPerson = $personPerson;

        return $this;
    }

    /**
     * Get personPerson
     *
     * @return \AppBundle\Entity\Person
     */
    public function getPersonPerson()
    {
        return $this->personPerson;
    }

    /**
     * returns the Student if person has Role Student
     * @return Student|null
     */
    public function getStudent()
    {
        return ($this->getPersonPerson()->isStudent())?$this->getPersonPerson()->getStudent():null;
    }

    /**
     * returns the Teacher if person has Role Teacher
     * @return Teacher|null
     */
    public function getTeacher()
    {
        return ($this->getPersonPerson()->isTeacher())?$this->getPersonPerson()->getTeacher():null;
    }

    /**
     * returns the TeacherAssistant if person has Role TeacherAssistant
     * @return TeacherAssistant|null
     */
    public function getTeacherAssistant()
    {
        return ($this->getPersonPerson()->isTeacherAssistant())?$this->getPersonPerson()->getTeacherAssistant():null;
    }
}
