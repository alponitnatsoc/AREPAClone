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
     * Get idTeacherHasRole
     *
     * @return integer
     */
    public function getIdTeacherHasRole()
    {
        return $this->idTeacherHasRole;
    }

    /**
     * Set teacherTeacher
     *
     * @param \AppBundle\Entity\Teacher $teacherTeacher
     *
     * @return TeacherHasRole
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

    /**
     * Set roleTypeRoleType
     *
     * @param \AppBundle\Entity\RoleType $roleTypeRoleType
     *
     * @return TeacherHasRole
     */
    public function setRoleTypeRoleType(\AppBundle\Entity\RoleType $roleTypeRoleType = null)
    {
        $this->roleTypeRoleType = $roleTypeRoleType;

        return $this;
    }

    /**
     * Get roleTypeRoleType
     *
     * @return \AppBundle\Entity\RoleType
     */
    public function getRoleTypeRoleType()
    {
        return $this->roleTypeRoleType;
    }
}
