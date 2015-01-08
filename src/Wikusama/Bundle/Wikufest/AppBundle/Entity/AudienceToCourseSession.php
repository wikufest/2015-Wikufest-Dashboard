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
 * AudienceToCourseSession
 *
 * @ORM\Table(name="audience_course_sessions")
 * @ORM\Entity(repositoryClass="Wikusama\Bundle\Wikufest\AppBundle\Repository\AudienceToCourseSessionRepository")
 */
class AudienceToCourseSession
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
     * @ORM\ManyToOne(targetEntity="\Wikusama\Bundle\Wikufest\AppBundle\Entity\User")
     * @ORM\JoinColumn(name="audience", referencedColumnName="id")
     **/
    private $audience;
    
     /**
     * @ORM\ManyToOne(targetEntity="\Wikusama\Bundle\Wikufest\AppBundle\Entity\CourseSession")
     * @ORM\JoinColumn(name="course_session_id", referencedColumnName="id")
     **/
    private $courseSession;
    
    /**
     * @ORM\Column(type="datetime", name="date_created")
     */
    private $dateCreated;

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
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     * @return AudienceToCourseSession
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
     * Set audience
     *
     * @param \Wikusama\Bundle\Wikufest\AppBundle\Entity\User $audience
     * @return AudienceToCourseSession
     */
    public function setAudience(\Wikusama\Bundle\Wikufest\AppBundle\Entity\User $audience = null)
    {
        $this->audience = $audience;

        return $this;
    }

    /**
     * Get audience
     *
     * @return \Wikusama\Bundle\Wikufest\AppBundle\Entity\User 
     */
    public function getAudience()
    {
        return $this->audience;
    }

    /**
     * Set courseSession
     *
     * @param \Wikusama\Bundle\Wikufest\AppBundle\Entity\CourseSession $courseSession
     * @return AudienceToCourseSession
     */
    public function setCourseSession(\Wikusama\Bundle\Wikufest\AppBundle\Entity\CourseSession $courseSession = null)
    {
        $this->courseSession = $courseSession;

        return $this;
    }

    /**
     * Get courseSession
     *
     * @return \Wikusama\Bundle\Wikufest\AppBundle\Entity\CourseSession 
     */
    public function getCourseSession()
    {
        return $this->courseSession;
    }
}
