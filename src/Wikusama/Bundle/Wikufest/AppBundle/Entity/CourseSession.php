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
 * CourseSession
 *
 * @ORM\Table(name="course_sessions")
 * @ORM\Entity(repositoryClass="Wikusama\Bundle\Wikufest\AppBundle\Repository\CourseSessionRepository")
 */
class CourseSession
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;
    
    /**
     * @ORM\ManyToOne(targetEntity="\Wikusama\Bundle\Wikufest\AppBundle\Entity\Course")
     * @ORM\JoinColumn(name="course_id", referencedColumnName="id")
     **/
    private $course;
    
    /**
     * @ORM\ManyToOne(targetEntity="\Wikusama\Bundle\Wikufest\AppBundle\Entity\Room")
     * @ORM\JoinColumn(name="room_id", referencedColumnName="id")
     **/
    private $room;
    
    /**
     * @ORM\Column(type="datetime", name="date_started")
     */
    private $dateStarted;
    
    /**
     * @ORM\Column(type="datetime", name="date_finished")
     */
    private $dateFinished;

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
     * Set name
     *
     * @param string $name
     * @return CourseSession
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
     * Set dateStarted
     *
     * @param \DateTime $dateStarted
     * @return CourseSession
     */
    public function setDateStarted($dateStarted)
    {
        $this->dateStarted = $dateStarted;

        return $this;
    }

    /**
     * Get dateStarted
     *
     * @return \DateTime 
     */
    public function getDateStarted()
    {
        return $this->dateStarted;
    }

    /**
     * Set dateFinished
     *
     * @param \DateTime $dateFinished
     * @return CourseSession
     */
    public function setDateFinished($dateFinished)
    {
        $this->dateFinished = $dateFinished;

        return $this;
    }

    /**
     * Get dateFinished
     *
     * @return \DateTime 
     */
    public function getDateFinished()
    {
        return $this->dateFinished;
    }

    /**
     * Set course
     *
     * @param \Wikusama\Bundle\Wikufest\AppBundle\Entity\Course $course
     * @return CourseSession
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
     * Set room
     *
     * @param \Wikusama\Bundle\Wikufest\AppBundle\Entity\Room $room
     * @return CourseSession
     */
    public function setRoom(\Wikusama\Bundle\Wikufest\AppBundle\Entity\Room $room = null)
    {
        $this->room = $room;

        return $this;
    }

    /**
     * Get room
     *
     * @return \Wikusama\Bundle\Wikufest\AppBundle\Entity\Room 
     */
    public function getRoom()
    {
        return $this->room;
    }
}
