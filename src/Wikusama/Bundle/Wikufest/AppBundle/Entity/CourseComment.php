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
 * CourseComment
 *
 * @ORM\Table(name="course_comments")
 * @ORM\Entity(repositoryClass="Wikusama\Bundle\Wikufest\AppBundle\Repository\CourseCommentRepository")
 */
class CourseComment
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
     * @ORM\Column(type="string",length=255, name="content")
     */
    private $content;
    
    /**
     * @ORM\Column(type="datetime", name="date_created")
     */
    private $dateCreated;
    
    /**
     * @ORM\ManyToOne(targetEntity="\Wikusama\Bundle\Wikufest\AppBundle\Entity\Course")
     * @ORM\JoinColumn(name="course_id", referencedColumnName="id")
     **/
    private $course;
    
    /**
     * @ORM\ManyToOne(targetEntity="\Wikusama\Bundle\Wikufest\AppBundle\Entity\User")
     * @ORM\JoinColumn(name="create_by", referencedColumnName="id")
     **/
    private $createBy;

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
     * Set content
     *
     * @param string $content
     * @return CourseComment
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     * @return CourseComment
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime 
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set course
     *
     * @param \Wikusama\Bundle\Wikufest\AppBundle\Entity\Course $course
     * @return CourseComment
     */
    public function setCourse(\Wikusama\Bundle\Wikufest\AppBundle\Entity\Course $course = null)
    {
        $this->course = $course;

        return $this;
    }

    /**
     * Get course
     *
     * @return \Wikusama\Bundle\Wikufest\AppBundle\Entity\Course 
     */
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * Set createBy
     *
     * @param \Wikusama\Bundle\Wikufest\AppBundle\Entity\User $createBy
     * @return CourseComment
     */
    public function setCreateBy(\Wikusama\Bundle\Wikufest\AppBundle\Entity\User $createBy = null)
    {
        $this->createBy = $createBy;

        return $this;
    }

    /**
     * Get createBy
     *
     * @return \Wikusama\Bundle\Wikufest\AppBundle\Entity\User 
     */
    public function getCreateBy()
    {
        return $this->createBy;
    }
}
