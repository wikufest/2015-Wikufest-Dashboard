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
use Wikusama\Bundle\Wikufest\AppBundle\Entity\UserProfile;

class Account
{
    protected $entityManager;
    protected $encoderFactory;

    public function __construct(EntityManager $entityManager, EncoderFactory $encoderFactory)
    {
        $this->entityManager = $entityManager;
        $this->encoderFactory = $encoderFactory;
    }
    
    public function activateAccount($username)
    {
        $user = $this->entityManager
                    ->getRepository("WikusamaWikufestAppBundle:User")->findOneBy(array(
                            'username' => $username
                        ));
        
        $user->setIsActive(true);
        
        $userProfle = $this->entityManager
                    ->getRepository("WikusamaWikufestAppBundle:UserProfile")->findOneBy(array(
                            'user' => $user
                        ));
                        
        $userProfle->setAccountActivation(\new DateTime());
        
        $this->entityManager->getConnection()->beginTransaction();
        
        try
        {
            
            $this->entityManager->persist($user);
            $this->entityManager->persist($userProfle);
        }
        }catch (Exception $e) {
            $this->entityManager->getConnection()->rollback();
            throw $e;
        }
        
        $this->entityManager->flush();
        $this->entityManager->getConnection()->commit();
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
        
        return $user;
    }
    
    public function createUserProfile(
            User $user,
            $fullname = ""
        )
    {
        $userProfle = new UserProfile();
        $userProfle->setUser($user);
        $userProfle->setFullname($fullname);
        
        $this->entityManager->persist($userProfle);
        $this->entityManager->flush();
        
        return $userProfle;
    }
    
    public function addUserToRole($username, $role)
    {
        $user = $this->entityManager
                    ->getRepository("WikusamaWikufestAppBundle:User")->findOneBy(array(
                            'username' => $username
                        ));
        
        $role = $this->entityManager
                    ->getRepository("WikusamaWikufestAppBundle:Role")->findOneBy(array(
                            'role' => $role
                        ));
        
        $user->addRole($role);
        $this->entityManager->persist($user);
    }
    
    public function importFromCsv($csvPath)
    {
        /**
         * [0] => Username
         * [1] => Email
         * [2] => Password
         * [3] => Fullname
         * [4] => Role
         */
         
        $fileHandler = fopen($csvPath,"r");
        
        $this->entityManager->getConnection()->beginTransaction();
        
        try
        {
            while (($row = fgetcsv($fileHandler)) !== FALSE)
            {
                $user = $this->createAccount(
                            $row[0], // Username
                            $row[1], // Email
                            $row[2]  // Passaword
                        );
                
                $userProfle = $this->createUserProfile(
                                $user,
                                $row[3] // Fullname
                            );         
                
                $this->addUserToRole(
                            $row[0], // Username
                            $row[4]  // Role
                        );
                
                $this->entityManager->flush();
            }
        }catch (Exception $e) {
            $this->entityManager->getConnection()->rollback();
            throw $e;
        }
        
        $this->entityManager->flush();
        $this->entityManager->getConnection()->commit();
    }
}
