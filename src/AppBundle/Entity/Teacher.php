<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 13/09/16
 * Time: 10:14 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Class Student
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="teacher",
 *     uniqueConstraints={
 *          @UniqueConstraint(
 *              name="personTeacherUnique", columns={"id_teacher", "person_id_person"}
 *          )
 *     })
 * @ORM\Entity
 */
class Teacher
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id_teacher",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idTeacher;

    /**
     * @var Person
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Person",inversedBy="idPerson", cascade={"persist"})
     * @ORM\JoinColumn(name="person_id_person",referencedColumnName="id_person")
     */
    private $personPerson;

    /**
     * @var string
     *
     * @ORM\Column(name="code_teacher",type="string",nullable=true)
     */
    private $teacherCode;

    /**
     * @ORM\ManyToMany( targetEntity="RoleType.php" , inversedBy="teachers", cascade={"persist"})
     * @ORM\JoinTable( name = "teacher_has_role",
     *      joinColumns = { @ORM\JoinColumn ( name = "id_teacher", referencedColumnName = "id_teacher" ) },
     *      inverseJoinColumns = { @ORM\JoinColumn ( name = "id_role_type" , referencedColumnName = "id_role_type" ) },
     *     )
     */
    private $roles;


    /**
     * Get idTeacher
     *
     * @return integer
     */
    public function getIdTeacher()
    {
        return $this->idTeacher;
    }

    /**
     * Set teacherCode
     *
     * @param string $teacherCode
     *
     * @return Teacher
     */
    public function setTeacherCode($teacherCode)
    {
        $this->teacherCode = $teacherCode;

        return $this;
    }

    /**
     * Get teacherCode
     *
     * @return string
     */
    public function getTeacherCode()
    {
        return $this->teacherCode;
    }

    /**
     * Set personPerson
     *
     * @param \AppBundle\Entity\Person $personPerson
     *
     * @return Teacher
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
     * Constructor
     */
    public function __construct()
    {
        $this->roles = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add role
     *
     * @param \AppBundle\Entity\roleType $role
     *
     * @return Teacher
     */
    public function addRole(\AppBundle\Entity\RoleType $role)
    {
        $this->roles[] = $role;

        return $this;
    }

    /**
     * Remove role
     *
     * @param \AppBundle\Entity\roleType $role
     */
    public function removeRole(\AppBundle\Entity\RoleType $role)
    {
        $this->roles->removeElement($role);
    }

    /**
     * Get roles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRoles()
    {
        return $this->roles;
    }
}
