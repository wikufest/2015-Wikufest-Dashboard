<?php

/*
 *
 * (c) 2015 Okta Purnama Rahadian <okta.rahadian@hotmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Wikusama\Bundle\Wikufest\AppBundle\Services;

use Doctrine\ORM\EntityManager;
use Wikusama\Bundle\Wikufest\AppBundle\Entity\UserBlog;

class UserBlog
{
    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    public function updatePosting(
            $userBlogId,
            $title,
            $content
        )
    {
        $post = $this->entityManager
                    ->getRepository("WikusamaWikufestAppBundle:UserNlog")->findOneBy(array(
                            'id' => $userBlogId
                        ));
                        
        $post->setDateModified(new \DateTime());
        $post->setTitle($title);
        $post->setContent($content);
        
        $this->entityManager->flush();
    }
    
    public function newPosting(
            $username,
            $title,
            $content
        )
    {
        $createBy = $this->entityManager
                    ->getRepository("WikusamaWikufestAppBundle:User")->findOneBy(array(
                            'username' => $username
                        ));

        $post = new UserBlog();
        $post->setDateCreated(new \DateTime());
        $post->setDateModified(new \DateTime());
        $post->setCreateBy($createBy);
        $post->setTitle($title);
        $post->setContent($content);
        
        $this->entityManager->persist($post);
        $this->entityManager->flush();
    }
}