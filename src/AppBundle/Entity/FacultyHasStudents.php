<?php
/**
 * Created by PhpStorm.
 * User: andresfelipe
 * Date: 10/21/16
 * Time: 8:51 AM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Class Section
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="faculty_has_students",
 *     indexes={
 *              @ORM\Index(name="fk_faculty_has_student",columns={"faculty_id"}),
 *              @ORM\Index(name="fk_student_has_faculty",columns={"student_id"})
 *     }
 * )
 * @ORM\Entity
 */
class FacultyHasStudents
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_faculty_has_students",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idFacultyHasStudents;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Faculty",inversedBy="facultyHasStudents",cascade={"persist"})
     * @ORM\JoinColumns(@ORM\JoinColumn(name="faculty_id",referencedColumnName="id_faculty"))
     */
    private $facultyFaculty;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Student",inversedBy="studentHasFaculty",cascade={"persist"})
     * @ORM\JoinColumns(@ORM\JoinColumn(name="student_id",referencedColumnName="id_student"))
     */
    private $studentStudent;


    /**
     * Get idFacultyHasStudents
     *
     * @return integer
     */
    public function getIdFacultyHasStudents()
    {
        return $this->idFacultyHasStudents;
    }

    /**
     * Set facultyFaculty
     *
     * @param \AppBundle\Entity\Faculty $facultyFaculty
     *
     * @return FacultyHasStudents
     */
    public function setFacultyFaculty(\AppBundle\Entity\Faculty $facultyFaculty = null)
    {
        $this->facultyFaculty = $facultyFaculty;

        return $this;
    }

    /**
     * Get facultyFaculty
     *
     * @return \AppBundle\Entity\Faculty
     */
    public function getFacultyFaculty()
    {
        return $this->facultyFaculty;
    }

    /**
     * Set studentStudent
     *
     * @param \AppBundle\Entity\Student $studentStudent
     *
     * @return FacultyHasStudents
     */
    public function setStudentStudent(\AppBundle\Entity\Student $studentStudent = null)
    {
        $this->studentStudent = $studentStudent;

        return $this;
    }

    /**
     * Get studentStudent
     *
     * @return \AppBundle\Entity\Student
     */
    public function getStudentStudent()
    {
        return $this->studentStudent;
    }
}
