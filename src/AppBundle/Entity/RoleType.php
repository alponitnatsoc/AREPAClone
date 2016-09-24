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
     * @ORM\Column(name="role_code",type="string",length=4)
     */
    private $roleCode;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\TeacherHasRole",mappedBy="roleTypeRoleType", cascade={"persist","remove"})
     */
    private $teachersHasRoles;

}
