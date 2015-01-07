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
use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use Wikusama\Bundle\Wikufest\AppBundle\Entity\User;

class Account
{
    protected $entityManager;
    protected $encoderFactory;

    public function __construct(EntityManager $entityManager, EncoderFactory $encoderFactory)
    {
        $this->entityManager = $entityManager;
        $this->encoderFactory = $encoderFactory;
    }
    
    public function createAccount(
                    $username, 
                    $email, 
                    $password
        )
    {
        $user = new User();
         
        $encoder = $this->encoderFactory->getEncoder($user);
        $pass = $encoder->encodePassword($password, $user->getSalt());
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setPassword($pass);

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}
