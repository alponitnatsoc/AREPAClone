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
 * @ORM\Table(name="faculty_has_courses",
 *     indexes={
 *              @ORM\Index(name="fk_faculty_has_course",columns={"faculty_id"}),
 *              @ORM\Index(name="fk_course_has_faculty",columns={"course_id"})
 *     },
 *     uniqueConstraints={
 *              @UniqueConstraint(name="uniqueFacultyCourse",columns={"faculty_id","course_id"},
 *              options={"where":"(((id_faculty_has_course IS NOT NULL) AND (course_id IS NULL) AND (faculty_id IS NULL)))"})
 *     }
 * )
 * @ORM\Entity
 */
class FacultyHasCourses
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_faculty_has_course",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idFacultyHasCourse;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Faculty",inversedBy="facultyHasCourses",cascade={"persist"})
     * @ORM\JoinColumns(@ORM\JoinColumn(name="faculty_id",referencedColumnName="id_faculty"))
     */
    private $facultyFaculty;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Course",inversedBy="courseHasfaculty",cascade={"persist"})
     * @ORM\JoinColumns(@ORM\JoinColumn(name="course_id",referencedColumnName="id_course"))
     */
    private $courseCourse;

    /**
     * Get idFacultyHasCourse
     *
     * @return integer
     */
    public function getIdFacultyHasCourse()
    {
        return $this->idFacultyHasCourse;
    }

    /**
     * Set facultyFaculty
     *
     * @param \AppBundle\Entity\Faculty $facultyFaculty
     *
     * @return FacultyHasCourses
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
     * Set courseCourse
     *
     * @param \AppBundle\Entity\Course $courseCourse
     *
     * @return FacultyHasCourses
     */
    public function setCourseCourse(\AppBundle\Entity\Course $courseCourse = null)
    {
        $this->courseCourse = $courseCourse;

        return $this;
    }

    /**
     * Get courseCourse
     *
     * @return \AppBundle\Entity\Course
     */
    public function getCourseCourse()
    {
        return $this->courseCourse;
    }
}
