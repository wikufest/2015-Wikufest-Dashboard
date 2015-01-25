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
use Doctrine\DBAL\Connection;
use Wikusama\Bundle\Wikufest\AppBundle\Entity\AudienceToCourseSession;

class Course
{
    protected $entityManager;
    protected $dbConnection;
    
    public function __construct(EntityManager $entityManager, Connection $dbConnection)
    {
        $this->entityManager = $entityManager;
        $this->dbConnection = $dbConnection;
    }
    
    public function registerAudienceToCourseSession($userId, $courseSessionId)
    {
        $sql = "INSERT INTO `audience_course_sessions`(`audience`, `course_session_id`, `date_created`) 
                    VALUES (:user_id,:course_session_id,CURRENT_TIMESTAMP)";
        
        $this->dbConnection->executeQuery($sql, [
            "user_id" => $userId,
            "course_session_id" => $courseSessionId
        ]);       
    }
    
}