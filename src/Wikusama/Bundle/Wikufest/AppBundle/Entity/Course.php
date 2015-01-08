<?php

/*
 *
 * (c) 2015 Okta Purnama Rahadian <okta.rahadian@hotmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Wikusama\Bundle\Wikufest\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Course
 *
 * @ORM\Table(name="courses")
 * @ORM\Entity(repositoryClass="Wikusama\Bundle\Wikufest\AppBundle\Repository\CourseRepository")
 */
class Course
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(name="is_private_class", type="boolean")
     */
    private $isPrivateClass;
    
    /**
     * @ORM\Column(name="title", type="string",length=255 )
     */
    private $title;
    
    /**
     * @ORM\Column(name="module_file_path", type="string",length=255 )
     */
    private $moduleFilePath;
    
    /**
     * @ORM\ManyToOne(targetEntity="\Wikusama\Bundle\Wikufest\AppBundle\Entity\User")
     * @ORM\JoinColumn(name="instructor", referencedColumnName="id")
     **/
    private $instructor;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set isPrivateClass
     *
     * @param boolean $isPrivateClass
     * @return Course
     */
    public function setIsPrivateClass($isPrivateClass)
    {
        $this->isPrivateClass = $isPrivateClass;

        return $this;
    }

    /**
     * Get isPrivateClass
     *
     * @return boolean 
     */
    public function getIsPrivateClass()
    {
        return $this->isPrivateClass;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Course
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set moduleFilePath
     *
     * @param string $moduleFilePath
     * @return Course
     */
    public function setModuleFilePath($moduleFilePath)
    {
        $this->moduleFilePath = $moduleFilePath;

        return $this;
    }

    /**
     * Get moduleFilePath
     *
     * @return string 
     */
    public function getModuleFilePath()
    {
        return $this->moduleFilePath;
    }

    /**
     * Set instructor
     *
     * @param \Wikusama\Bundle\Wikufest\AppBundle\Entity\User $instructor
     * @return Course
     */
    public function setInstructor(\Wikusama\Bundle\Wikufest\AppBundle\Entity\User $instructor = null)
    {
        $this->instructor = $instructor;

        return $this;
    }

    /**
     * Get instructor
     *
     * @return \Wikusama\Bundle\Wikufest\AppBundle\Entity\User 
     */
    public function getInstructor()
    {
        return $this->instructor;
    }
}
