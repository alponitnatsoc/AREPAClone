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
     * @ORM\ManyToMany( targetEntity="RoleType" , inversedBy="teachers", cascade={"persist"})
     * @ORM\JoinTable( name = "teacher_has_role",
     *      joinColumns = { @ORM\JoinColumn ( name = "id_teacher", referencedColumnName = "id_teacher" ) },
     *      inverseJoinColumns = { @ORM\JoinColumn ( name = "id_role_type" , referencedColumnName = "id_role_type" ) },
     *     )
     */
    private $roles;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\TeacherHasClass",mappedBy="teacherTeacher",cascade={"persist"})
     */
    private $teacherHasClasses;

}
