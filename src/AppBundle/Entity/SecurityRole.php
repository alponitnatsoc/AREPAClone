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
 * Class securityRole
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="security_role",
 *     uniqueConstraints={
 *          @UniqueConstraint(
 *              name="code_role_type_unique", columns={"code"}
 *          )
 *     })
 * @ORM\Entity
 */
class SecurityRole
{
    /**
     * @var integer
     * @ORM\Column(name="id_security_role", type="integer")
         * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idSecurityRole;

    /**
     * @var string
     * @ORM\Column(type="string",length=100)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(name="code",type="string",length=20)
     */
    private $code;

    /**
     * Get idSecurityRole
     *
     * @return integer
     */
    public function getIdSecurityRole()
    {
        return $this->idSecurityRole;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return SecurityRole
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return SecurityRole
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }
}
