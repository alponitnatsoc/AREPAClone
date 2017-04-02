<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 14/09/16
 * Time: 06:57 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Class BloomLevel
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="bloom_level")
 * @ORM\Entity
 */
class BloomLevel
{

    /**
     * @var integer
     *
     * @ORM\Column(name="level",type="integer",length=2, nullable=FALSE)
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $level;

    /**
     * Set level
     *
     * @param integer $level
     *
     * @return BloomLevel
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return integer
     */
    public function getLevel()
    {
        return $this->level;
    }

    public function __toString()
    {
        switch ($this->level){
            case 1:
                return "I";
                break;
            case 2:
                return "II";
                break;
            case 3:
                return "III";
                break;
        }
    }
}
