<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 27/02/17
 * Time: 12:29 PM
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Role
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="role")
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"student" = "Student","teacher"="Teacher","teacher_assistant"="TeacherAssistant"})
 */
abstract class Role
{
    /**
     * @var integer
     * @ORM\Column(name="id_role",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $idRole;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Person", inversedBy="personRole", cascade={"persist"})
     * @ORM\JoinColumn(name="person_id",referencedColumnName="id_person", nullable=TRUE)
     */
    protected $person;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Faculty",mappedBy="roles", cascade={"persist"})
     */
    protected $faculties;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\ClassCourse", inversedBy="roles", cascade={"persist"})
     * @ORM\JoinTable(name="role_has_class_course",
     *      joinColumns={@ORM\JoinColumn(name="role_id",referencedColumnName="id_role")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="class_course_id",referencedColumnName="id_class_course")}
     *     )
     */
    protected $classCourses;

    /**
     * get class
     * returns the name of the class for the child entities
     * @return string
     */
    public function getClass(){
        $path = explode('\\', __CLASS__);
        return array_pop($path);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getClass();
    }


    /**
     * Role constructor.
     * @param Person|null $person
     */
    public function __construct(Person $person = null)
    {
        $this->person = $person;
        $this->faculties = new \Doctrine\Common\Collections\ArrayCollection();
        $this->classCourses = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get idRole
     *
     * @return integer
     */
    public function getIdRole()
    {
        return $this->idRole;
    }

    /**
     * Set person
     *
     * @param \AppBundle\Entity\Person $person
     *
     * @return Role
     */
    public function setPerson(\AppBundle\Entity\Person $person = null)
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

    /**
     * Add faculty
     *
     * @param \AppBundle\Entity\Faculty $faculty
     *
     * @return Role
     */
    public function addFaculty(\AppBundle\Entity\Faculty $faculty)
    {
        $this->faculties[] = $faculty;
        return $this;
    }

    /**
     * Remove faculty
     *
     * @param \AppBundle\Entity\Faculty $faculty
     */
    public function removeFaculty(\AppBundle\Entity\Faculty $faculty)
    {
        $this->faculties->removeElement($faculty);
    }

    /**
     * Get faculties
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFaculties()
    {
        return $this->faculties;
    }

    /**
     * Add classCourse
     *
     * @param \AppBundle\Entity\ClassCourse $classCourse
     *
     * @return Role
     */
    public function addClassCourse(\AppBundle\Entity\ClassCourse $classCourse)
    {
        $this->classCourses[] = $classCourse;

        return $this;
    }

    /**
     * Remove classCourse
     *
     * @param \AppBundle\Entity\ClassCourse $classCourse
     */
    public function removeClassCourse(\AppBundle\Entity\ClassCourse $classCourse)
    {
        $this->classCourses->removeElement($classCourse);
    }

    /**
     * Get classCourses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClassCourses()
    {
        return $this->classCourses;
    }
}
