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
 * UserProfile
 *
 * @ORM\Table(name="user_profiles")
 * @ORM\Entity(repositoryClass="Wikusama\Bundle\Wikufest\AppBundle\Repository\UserProfileRepository")
 */
class UserProfile
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fullname;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $occupacy;
    
    /**
     * @ORM\Column(type="string", length=255, name="company_name", nullable=true)
     */
    private $companyName;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $summary;
    
    /**
     * @ORM\Column(type="string", length=255, name="profile_picture_path", nullable=true)
     */
    private $profilePicturePath;
    
    /**
     * @ORM\Column(type="string", length=255, name="twitter_account", nullable=true)
     */
    private $twitterAccount;
    
    /**
     * @ORM\Column(type="string", length=255, name="facebook_account", nullable=true)
     */
    private $facebookAccount;
    
    /**
     * @ORM\Column(type="string", length=255, name="linkedin_account", nullable=true)
     */
    private $linkedinAccount;
    
    /**
     * @ORM\Column(type="string", length=255, name="student_class_name", nullable=true)
     */
    private $studentClassName;
    
    /**
     * @ORM\Column(type="string", length=255, name="student_id_number", nullable=true)
     */
    private $studentIdNumber;
    
    /**
     * @ORM\Column(type="string", length=255, name="phone_number", nullable=true)
     */
    private $phoneNumber;
    
    /**
     * @ORM\Column(type="string", length=1, name="gender", nullable=true)
     */
    private $gender;
    
    /**
     * @ORM\Column(type="datetime", name="account_activation", nullable=true)
     */
    private $accountActivation;
    
    /**
     * @ORM\Column(type="datetime", name="date_created", nullable=true)
     */
    private $dateCreated;
    
    /**
     * @ORM\OneToOne(targetEntity="\Wikusama\Bundle\Wikufest\AppBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     **/
    private $user;
    
    /**
     * @ORM\ManyToOne(targetEntity="\Wikusama\Bundle\Wikufest\AppBundle\Entity\AudiencePromoCodeStatus")
     * @ORM\JoinColumn(name="audience_promocode_status_id", referencedColumnName="id")
     **/
    private $audiencePromoCodeStatus;

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
     * Set fullname
     *
     * @param string $fullname
     * @return UserProfile
     */
    public function setFullname($fullname)
    {
        $this->fullname = $fullname;

        return $this;
    }

    /**
     * Get fullname
     *
     * @return string 
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * Set user
     *
     * @param \Wikusama\Bundle\Wikufest\AppBundle\Entity\User $user
     * @return UserProfile
     */
    public function setUser(\Wikusama\Bundle\Wikufest\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Wikusama\Bundle\Wikufest\AppBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set occupacy
     *
     * @param string $occupacy
     * @return UserProfile
     */
    public function setOccupacy($occupacy)
    {
        $this->occupacy = $occupacy;

        return $this;
    }

    /**
     * Get occupacy
     *
     * @return string 
     */
    public function getOccupacy()
    {
        return $this->occupacy;
    }

    /**
     * Set companyName
     *
     * @param string $companyName
     * @return UserProfile
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;

        return $this;
    }

    /**
     * Get companyName
     *
     * @return string 
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * Set summary
     *
     * @param string $summary
     * @return UserProfile
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;

        return $this;
    }

    /**
     * Get summary
     *
     * @return string 
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Set profilePicturePath
     *
     * @param string $profilePicturePath
     * @return UserProfile
     */
    public function setProfilePicturePath($profilePicturePath)
    {
        $this->profilePicturePath = $profilePicturePath;

        return $this;
    }

    /**
     * Get profilePicturePath
     *
     * @return string 
     */
    public function getProfilePicturePath()
    {
        return $this->profilePicturePath;
    }

    /**
     * Set twitterAccount
     *
     * @param string $twitterAccount
     * @return UserProfile
     */
    public function setTwitterAccount($twitterAccount)
    {
        $this->twitterAccount = $twitterAccount;

        return $this;
    }

    /**
     * Get twitterAccount
     *
     * @return string 
     */
    public function getTwitterAccount()
    {
        return $this->twitterAccount;
    }

    /**
     * Set facebookAccount
     *
     * @param string $facebookAccount
     * @return UserProfile
     */
    public function setFacebookAccount($facebookAccount)
    {
        $this->facebookAccount = $facebookAccount;

        return $this;
    }

    /**
     * Get facebookAccount
     *
     * @return string 
     */
    public function getFacebookAccount()
    {
        return $this->facebookAccount;
    }

    /**
     * Set linkedinAccount
     *
     * @param string $linkedinAccount
     * @return UserProfile
     */
    public function setLinkedinAccount($linkedinAccount)
    {
        $this->linkedinAccount = $linkedinAccount;

        return $this;
    }

    /**
     * Get linkedinAccount
     *
     * @return string 
     */
    public function getLinkedinAccount()
    {
        return $this->linkedinAccount;
    }

    /**
     * Set studentIdNumber
     *
     * @param string $studentIdNumber
     * @return UserProfile
     */
    public function setStudentIdNumber($studentIdNumber)
    {
        $this->studentIdNumber = $studentIdNumber;

        return $this;
    }

    /**
     * Get studentIdNumber
     *
     * @return string 
     */
    public function getStudentIdNumber()
    {
        return $this->studentIdNumber;
    }

    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     * @return UserProfile
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return string 
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set accountActivation
     *
     * @param \DateTime $accountActivation
     * @return UserProfile
     */
    public function setAccountActivation($accountActivation)
    {
        $this->accountActivation = $accountActivation;

        return $this;
    }

    /**
     * Get accountActivation
     *
     * @return \DateTime 
     */
    public function getAccountActivation()
    {
        return $this->accountActivation;
    }

    /**
     * Set studentClassName
     *
     * @param string $studentClassName
     * @return UserProfile
     */
    public function setStudentClassName($studentClassName)
    {
        $this->studentClassName = $studentClassName;

        return $this;
    }

    /**
     * Get studentClassName
     *
     * @return string 
     */
    public function getStudentClassName()
    {
        return $this->studentClassName;
    }

    /**
     * Set audiencePromoCodeStatus
     *
     * @param \Wikusama\Bundle\Wikufest\AppBundle\Entity\AudiencePromoCodeStatus $audiencePromoCodeStatus
     * @return UserProfile
     */
    public function setAudiencePromoCodeStatus(\Wikusama\Bundle\Wikufest\AppBundle\Entity\AudiencePromoCodeStatus $audiencePromoCodeStatus = null)
    {
        $this->audiencePromoCodeStatus = $audiencePromoCodeStatus;

        return $this;
    }

    /**
     * Get audiencePromoCodeStatus
     *
     * @return \Wikusama\Bundle\Wikufest\AppBundle\Entity\AudiencePromoCodeStatus 
     */
    public function getAudiencePromoCodeStatus()
    {
        return $this->audiencePromoCodeStatus;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     * @return UserProfile
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
     * Set gender
     *
     * @param string $gender
     * @return UserProfile
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string 
     */
    public function getGender()
    {
        return $this->gender;
    }
}
