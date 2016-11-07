<?php
/**
 * Created by PhpStorm.
 * User: erikaxu
 * Date: 14/09/16
 * Time: 06:57 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Class File
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="file")
 * @ORM\Entity
 */
class File
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id_outcome",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idFile;

    /**
     * @var string
     *
     * @ORM\Column(name="name",type="string", length=10, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="context",type="string",nullable=true)
     */
    private $context;

    /**
     * @var string
     *
     * @ORM\Column(name="file_type",type="string",nullable=true)
     */
    private $fileType;

    /**
     *
     * @ORM\Column(name="created_at",type="datetime",nullable=true)
     */
    private $createdAt;

    /**
     *
     * @ORM\Column(name="updated_at",type="datetime",nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\Column(name="size",type="integer",nullable=true)
     */
    private $size;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\DocumentType", inversedBy="documentsDocuments")
     * @ORM\Column(name="document_type",nullable=true)
     */
    private $documentType;

    public function prePersist()
    {
        $this->setCreatedAt(new \DateTime());
        $this->setUpdatedAt(new \DateTime());
    }

    public function preUpdate()
    {
        $this->setUpdatedAt(new \DateTime());
    }

    /**
     * Get idFile
     *
     * @return integer
     */
    public function getIdFile()
    {
        return $this->idFile;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return File
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
     * Set context
     *
     * @param string $context
     *
     * @return File
     */
    public function setContext($context)
    {
        $this->context = $context;

        return $this;
    }

    /**
     * Get context
     *
     * @return string
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * Set fileType
     *
     * @param string $fileType
     *
     * @return File
     */
    public function setFileType($fileType)
    {
        $this->fileType = $fileType;

        return $this;
    }

    /**
     * Get fileType
     *
     * @return string
     */
    public function getFileType()
    {
        return $this->fileType;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return File
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return File
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set size
     *
     * @param integer $size
     *
     * @return File
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return integer
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set documentType
     *
     * @param string $documentType
     *
     * @return File
     */
    public function setDocumentType($documentType)
    {
        $this->documentType = $documentType;

        return $this;
    }

    /**
     * Get documentType
     *
     * @return string
     */
    public function getDocumentType()
    {
        return $this->documentType;
    }
}
