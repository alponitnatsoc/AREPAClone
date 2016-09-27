<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 17/09/16
 * Time: 05:11 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class TeacherHasRole
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="teacher_has_role")
 * @ORM\Entity
 */

class TeacherHasRole
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id_teacher_has_role",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idTeacherHasRole;

    /**
     * @var Teacher
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Teacher", inversedBy="teacherHasRoles")
     * @ORM\JoinColumn(name="teacher_id", referencedColumnName="id_teacher")
     */
    private $teacherTeacher;

    /**
     * @var RoleType
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\RoleType", inversedBy="teacherHasRoles")
     * @ORM\JoinColumn(name="role_type_id", referencedColumnName="id_role_type")
     */
    private $roleTypeRoleType;

    /**
     * TODO
     * @var string
     */
    private $configurations;

}