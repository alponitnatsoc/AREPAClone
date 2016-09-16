<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 13/09/16
 * Time: 11:32 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Class roleType
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="role_Type",
 *     uniqueConstraints={
 *          @UniqueConstraint(
 *              name="codeTypeUnique", columns={"role_code"}
 *          )
 *     })
 * @ORM\Entity
 */
class RoleType
{
    /**
     * @var integer
     * @ORM\Column(name="id_role_type", type="integer")
         * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idRoleType;

    /**
     * @var string
     * @ORM\Column(type="string",length=100)
     */
    private $roleName;

    /**
     * @var string
     * @ORM\Column(name="role_code",type="string",length=4)
     */
    private $roleCode;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Teacher",mappedBy="roles")
     */
    private $teachers;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->teachers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get idRoleType
     *
     * @return integer
     */
    public function getIdRoleType()
    {
        return $this->idRoleType;
    }

    /**
     * Set roleName
     *
     * @param string $roleName
     *
     * @return RoleType
     */
    public function setRoleName($roleName)
    {
        $this->roleName = $roleName;

        return $this;
    }

    /**
     * Get roleName
     *
     * @return string
     */
    public function getRoleName()
    {
        return $this->roleName;
    }

    /**
     * Set roleCode
     *
     * @param string $roleCode
     *
     * @return RoleType
     */
    public function setRoleCode($roleCode)
    {
        $this->roleCode = $roleCode;

        return $this;
    }

    /**
     * Get roleCode
     *
     * @return string
     */
    public function getRoleCode()
    {
        return $this->roleCode;
    }

    /**
     * Add teacher
     *
     * @param \AppBundle\Entity\Teacher $teacher
     *
     * @return RoleType
     */
    public function addTeacher(\AppBundle\Entity\Teacher $teacher)
    {
        $this->teachers[] = $teacher;

        return $this;
    }

    /**
     * Remove teacher
     *
     * @param \AppBundle\Entity\Teacher $teacher
     */
    public function removeTeacher(\AppBundle\Entity\Teacher $teacher)
    {
        $this->teachers->removeElement($teacher);
    }

    /**
     * Get teachers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTeachers()
    {
        return $this->teachers;
    }
}
