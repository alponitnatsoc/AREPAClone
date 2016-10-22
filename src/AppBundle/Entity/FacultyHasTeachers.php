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
 * @ORM\Table(name="faculty_has_teachers",
 *     indexes={
 *              @ORM\Index(name="fk_faculty_has_course",columns={"faculty_id"}),
 *              @ORM\Index(name="fk_course_has_faculty",columns={"teacher_id"})
 *     },
 *     uniqueConstraints={
 *              @UniqueConstraint(name="uniqueFacultyCourse",columns={"faculty_id","teacher_id"},
 *              options={"where":"(((id_faculty_has_teachers IS NOT NULL) AND (teacher_id IS NULL) AND (faculty_id IS NULL)))"})
 *     }
 * )
 * @ORM\Entity
 */
class FacultyHasTeachers
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_faculty_has_teachers",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idFacultyHasTeachers;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Faculty",inversedBy="facultyHasTeacher",cascade={"persist"})
     * @ORM\JoinColumns(@ORM\JoinColumn(name="faculty_id",referencedColumnName="id_faculty"))
     */
    private $facultyFaculty;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Teacher",inversedBy="teacherHasfaculty",cascade={"persist"})
     * @ORM\JoinColumns(@ORM\JoinColumn(name="teacher_id",referencedColumnName="id_teacher"))
     */
    private $teacherTeacher;


    /**
     * Get idFacultyHasTeachers
     *
     * @return integer
     */
    public function getIdFacultyHasTeachers()
    {
        return $this->idFacultyHasTeachers;
    }

    /**
     * Set facultyFaculty
     *
     * @param \AppBundle\Entity\Faculty $facultyFaculty
     *
     * @return FacultyHasTeachers
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
     * Set teacherTeacher
     *
     * @param \AppBundle\Entity\Teacher $teacherTeacher
     *
     * @return FacultyHasTeachers
     */
    public function setTeacherTeacher(\AppBundle\Entity\Teacher $teacherTeacher = null)
    {
        $this->teacherTeacher = $teacherTeacher;

        return $this;
    }

    /**
     * Get teacherTeacher
     *
     * @return \AppBundle\Entity\Teacher
     */
    public function getTeacherTeacher()
    {
        return $this->teacherTeacher;
    }
}
