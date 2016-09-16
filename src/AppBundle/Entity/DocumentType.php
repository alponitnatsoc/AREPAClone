<?php
/**
 * Created by PhpStorm.
 * User: erikaxu
 * Date: 14/09/16
 * Time: 07:07 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Class DocumentType
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="document_type",
 *     uniqueConstraints={
 *          @UniqueConstraint(
 *              name="personStudentUnique", columns={"code"}
 *          )
 *     })
 * @ORM\Entity
 */

class DocumentType
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id_document_type",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idDocumentType;

    /**
     * @var string
     *
     * @ORM\Column(name="code",type="string", length=5, nullable=true)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="name",type="string", length=20, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="template", type="string", length=20, nullable=true)
     */
    private $template;

    /**
     * Get idDocumentType
     *
     * @return integer
     */
    public function getIdDocumentType()
    {
        return $this->idDocumentType;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return DocumentType
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

    /**
     * Set name
     *
     * @param string $name
     *
     * @return DocumentType
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
     * Set template
     *
     * @param string $template
     *
     * @return DocumentType
     */
    public function setTemplate($template)
    {
        $this->template = $template;

        return $this;
    }

    /**
     * Get template
     *
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }
}
