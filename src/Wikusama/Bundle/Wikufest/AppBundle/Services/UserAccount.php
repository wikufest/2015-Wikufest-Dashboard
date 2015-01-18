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

class UserAccount
{
    protected $entityManager;
    protected $encoderFactory;

    public function __construct(EntityManager $entityManager, EncoderFactory $encoderFactory)
    {
        $this->entityManager = $entityManager;
        $this->encoderFactory = $encoderFactory;
    }
    
    public function bulkActivateFromCsv($csvPath)
    {
        /**
         * [0] => Username
         * [1] => Email
         */
        
        $fileHandler = fopen($csvPath,"r");

        $index = 0;
        $batchSize = 20;
        while (($row = fgetcsv($fileHandler)) !== FALSE)
        {
            $this->activateAccount(
                    $row[0], // Username
                    $row[1] // Email
                );
            
            $this->entityManager->flush();
            
            if (($index % $batchSize) === 0) {
                $this->entityManager->flush();
                $this->entityManager->clear();
            }
            
            $index++;
        }
        
        $this->entityManager->flush();
        $this->entityManager->clear();
    }
    
    public function activateAccount($username, $email = null)
    {
        $this->entityManager->getConnection()->beginTransaction();
        
        try
        {
            $user = $this->entityManager
                    ->getRepository("WikusamaWikufestAppBundle:User")->findOneBy(array(
                            'username' => $username
                        ));
            
            if(!$user->getIsActive())
            {
                // If user is inActive position then do activation if not do nothing
                $user->setIsActive(true);
                $userNewPassword = $this->getRandomPassword();
                
                $encoder = $this->encoderFactory->getEncoder($user);
                $pass = $encoder->encodePassword($userNewPassword, $user->getSalt());
                
                if($email !== null && $email  !== "")
                {
                    $user->setEmail($email);
                }
                
                $user->setPassword($password);
                
                
                $userProfle = $this->entityManager
                            ->getRepository("WikusamaWikufestAppBundle:UserProfile")->findOneBy(array(
                                    'user' => $user
                                ));
                
                $userProfle->setAccountActivation(new \DateTime());
                
                
                
                $this->entityManager->persist($user);
                $this->entityManager->persist($userProfle);
            }
        }catch (\Exception $e) {
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
            $values = array()
        )
    {
        $userProfle = new UserProfile();
        $userProfle->setUser($user);
        
        if(isset($values['fullname']) && $values['fullname'] !== "")
        {
            $userProfle->setFullname($values['fullname']);
        }
        
        if(isset($values['studentClassName']) && $values['studentClassName'] !== "")
        {
            $userProfle->setStudentClassName($values['studentClassName']);
        }
        
        if(isset($values['gender']) && $values['gender'] !== "")
        {
            $userProfle->setGender($values['gender']);
        }
        
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
        
        $user->clearRole();
        $user->addRole($role);
        
        $this->entityManager->persist($user);
    }
    
    public function bulkCreateFromCsv($csvPath)
    {
        /**
         * [0] => Username
         * [1] => Email
         * [2] => Fullname
         * [3] => Student ID Number
         * [4] => Student Class Number
         * [5] => Gender
         * [6] => Password
         * [7] => Role
         */
         
        $fileHandler = fopen($csvPath,"r");
        
        $this->entityManager->getConnection()->beginTransaction();
        
        try
        {
            $index = 0;
            $batchSize = 20;
            while (($row = fgetcsv($fileHandler)) !== FALSE)
            {
                $user = $this->createAccount(
                            $row[0], // Username
                            $row[1], // Email
                            $row[6]  // Password
                        );     

                $userProfile = $this->createUserProfile(
                                $user,
                                array(
                                    "fullname" => $row[2],
                                    "studentClassName" => $row[4],
                                    "gender" => $row[5]
                                )
                            );
                            
                $this->addUserToRole(
                            $row[0], // Username
                            $row[7]  // Role
                        );
                
                $this->entityManager->persist($user);
                $this->entityManager->persist($userProfile);
                
                $this->entityManager->flush();
                
                if (($index % $batchSize) === 0) {
                    $this->entityManager->flush();
                    $this->entityManager->clear();
                }
                
                $index++;
            }
        }catch (\Exception $e) {
            $this->entityManager->getConnection()->rollback();
            throw $e;
        }
        
        $this->entityManager->getConnection()->commit();
        $this->entityManager->flush();
        $this->entityManager->clear();
    }
    
    public function generateRandomPassword()
    {
        return bin2hex(openssl_random_pseudo_bytes(4));
    }
}
