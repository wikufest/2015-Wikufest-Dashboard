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
 * UserBlog
 *
 * @ORM\Table(name="user_blogs")
 * @ORM\Entity(repositoryClass="Wikusama\Bundle\Wikufest\AppBundle\Repository\UserBlogRepository")
 */
class UserBlog
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
     * @ORM\Column(type="string", length=255, name="title")
     */
    private $title;
    
    /**
     * @ORM\Column(type="text", name="content")
     */
    private $content;
    
    /**
     * @ORM\Column(type="string", length=255, name="permalink")
     */
    private $permalink;
    
     /**
     * @ORM\Column(type="string", length=255, name="url")
     */
    private $url;
    
    /**
     * @ORM\Column(type="datetime", name="date_created")
     */
    private $dateCreated;
    
    /**
     * @ORM\Column(type="datetime", name="date_modified")
     */
    private $dateModified;
    
    /**
     * @ORM\ManyToOne(targetEntity="\Wikusama\Bundle\Wikufest\AppBundle\Entity\User")
     * @ORM\JoinColumn(name="create_by", referencedColumnName="id")
     **/
    private $createBy;
    
    /**
     * @ORM\ManyToOne(targetEntity="\Wikusama\Bundle\Wikufest\AppBundle\Entity\UserBlogStatus")
     * @ORM\JoinColumn(name="user_blog_status_id", referencedColumnName="id")
     **/
    private $status;


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
     * Set title
     *
     * @param string $title
     * @return UserBlog
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
     * Set permalink
     *
     * @param string $permalink
     * @return UserBlog
     */
    public function setPermalink($permalink)
    {
        $this->permalink = $permalink;

        return $this;
    }

    /**
     * Get permalink
     *
     * @return string 
     */
    public function getPermalink()
    {
        return $this->permalink;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return UserBlog
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     * @return UserBlog
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
     * Set dateModified
     *
     * @param \DateTime $dateModified
     * @return UserBlog
     */
    public function setDateModified($dateModified)
    {
        $this->dateModified = $dateModified;

        return $this;
    }

    /**
     * Get dateModified
     *
     * @return \DateTime 
     */
    public function getDateModified()
    {
        return $this->dateModified;
    }

    /**
     * Set createBy
     *
     * @param \Wikusama\Bundle\Wikufest\AppBundle\Entity\User $createBy
     * @return UserBlog
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

    /**
     * Set content
     *
     * @param string $content
     * @return UserBlog
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
     * Set status
     *
     * @param \Wikusama\Bundle\Wikufest\AppBundle\Entity\UserBlogStatus $status
     * @return UserBlog
     */
    public function setStatus(\Wikusama\Bundle\Wikufest\AppBundle\Entity\UserBlogStatus $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \Wikusama\Bundle\Wikufest\AppBundle\Entity\UserBlogStatus 
     */
    public function getStatus()
    {
        return $this->status;
    }
}
