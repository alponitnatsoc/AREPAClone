<?php
/**
 * Created by PhpStorm.
 * User: erikaxu
 * Date: 14/09/16
 * Time: 12:22 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Class ClassCourse
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="class_course",
 *     uniqueConstraints={
 *          @UniqueConstraint(
 *              name="codeClassUnique", columns={"class_code","active_period"}
 *          )
 *     })
 * @ORM\Entity
 */
class ClassCourse
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_class_course",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idClassCourse;

    /**
     * @var string
     *
     * @ORM\Column(name="class_code", type="string", length=8, nullable=true)
     */
    private $classCode;

    /**
     * @var string
     *
     * @ORM\Column(name="active_period",type="string", length=7,nullable=true)
     */
    private $activePeriod;

    /**
     * @var Course
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Course", inversedBy="classCourses", cascade={"persist"})
     * @ORM\JoinColumn(name="course_id", referencedColumnName="id_course")
     */
    private $course;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Role", mappedBy="classCourses",cascade={"persist"})
     */
    private $roles;

    public function __toString()
    {
        return $this->classCode.' '.$this->activePeriod;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->roles = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get idClassCourse
     *
     * @return integer
     */
    public function getIdClassCourse()
    {
        return $this->idClassCourse;
    }

    /**
     * Set classCode
     *
     * @param string $classCode
     *
     * @return ClassCourse
     */
    public function setClassCode($classCode)
    {
        $this->classCode = $classCode;

        return $this;
    }

    /**
     * Get classCode
     *
     * @return string
     */
    public function getClassCode()
    {
        return $this->classCode;
    }

    /**
     * Set activePeriod
     *
     * @param string $activePeriod
     *
     * @return ClassCourse
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
     * Set course
     *
     * @param \AppBundle\Entity\Course $course
     *
     * @return ClassCourse
     */
    public function setCourse(\AppBundle\Entity\Course $course = null)
    {
        $this->course = $course;

        return $this;
    }

    /**
     * Get course
     *
     * @return \AppBundle\Entity\Course
     */
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * Add role
     *
     * @param \AppBundle\Entity\Role $role
     *
     * @return ClassCourse
     */
    public function addRole(\AppBundle\Entity\Role $role)
    {
        $this->roles[] = $role;

        return $this;
    }

    /**
     * Remove role
     *
     * @param \AppBundle\Entity\Role $role
     */
    public function removeRole(\AppBundle\Entity\Role $role)
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
