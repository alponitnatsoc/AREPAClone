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
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Person",inversedBy="teacher", cascade={"persist"})
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
     * @ORM\OneToMany( targetEntity="AppBundle\Entity\TeacherHasRole" , mappedBy="teacherTeacher", cascade={"persist","remove"})
     */
    private $teacherHasRoles;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\TeacherDictatesCourse",mappedBy="teacherTeacher",cascade={"persist","remove"})
     */
    private $teacherDictatesCourses;
}
