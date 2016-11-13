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
 *              name="code_role_type_unique", columns={"role_code"}
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
     * @ORM\Column(name="role_code",type="string",length=20)
     */
    private $roleCode;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\TeacherHasRole",mappedBy="roleTypeRoleType", cascade={"persist","remove"})
     */
    private $teachersHasRoles;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->teachersHasRoles = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add teachersHasRole
     *
     * @param \AppBundle\Entity\TeacherHasRole $teachersHasRole
     *
     * @return RoleType
     */
    public function addTeachersHasRole(\AppBundle\Entity\TeacherHasRole $teachersHasRole)
    {
        $this->teachersHasRoles[] = $teachersHasRole;
        $teachersHasRole->setRoleTypeRoleType($this);
        return $this;
    }

    /**
     * Remove teachersHasRole
     *
     * @param \AppBundle\Entity\TeacherHasRole $teachersHasRole
     */
    public function removeTeachersHasRole(\AppBundle\Entity\TeacherHasRole $teachersHasRole)
    {
        $this->teachersHasRoles->removeElement($teachersHasRole);
    }

    /**
     * Get teachersHasRoles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTeachersHasRoles()
    {
        return $this->teachersHasRoles;
    }
}
