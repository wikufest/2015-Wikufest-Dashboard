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
    protected $isAudienceCanChooseCourses;
    
    public function __construct(EntityManager $entityManager, $isAudienceCanChooseCourses)
    {
        $this->entityManager = $entityManager;
        $this->dbConnection = $entityManager->getConnection();
        $this->isAudienceCanChooseCourses = $isAudienceCanChooseCourses;
    }
    
    public function getFormatedCourses()
    {
        // Data example
        /**
        {
          "k_665c5bf9f6ace0431ce1cebfff6ee49a": {
            "session_started": "2015-01-30 09:00:00",
            "session_finished": "2015-01-30 12:00:00",
            "h_session_started_date": "30 January 2015",
            "h_session_finished_date": "30 January 2015",
            "session_started_date": "2015-01-30",
            "session_finished_date": "2015-01-30",
            "h_session_started_hour": "09:00",
            "h_session_finished_hour": "12:00",
            "session_started_hour": "09:00:00",
            "session_finished_hour": "12:00:00",
            "courses": [
              {
                "instructor_name": "Foo Bar",
                "course_title": "Foo Title",
                "session_started": "2015-01-30 09:00:00",
                "session_finished": "2015-01-30 12:00:00",
                "session_duration": "180",
                "session_id": "1",
                "room_name": "Room 1",
                "total_current_audience": "2",
                "session_capacity": "40",
                "course_summary": "Lorem ipsum dolor sit amet",
                "is_more_than_one_session": "1"
              }
            ]
          }
        }
        */
        $courses = $this
                    ->entityManager
                    ->getRepository("WikusamaWikufestAppBundle:CourseSession")
                    ->loadAll();
        
        $formatedResult = [];
        
        foreach($courses as $row){
            $fSessionStarted = "k_".md5($this->combineDateString($row['session_started']) . $this->combineDateString($row['session_finished']));
            if(!array_key_exists($fSessionStarted, $formatedResult)){
                $formatedResult[$fSessionStarted]['session_started'] = $row['session_started'];
                $formatedResult[$fSessionStarted]['session_finished'] = $row['session_finished'];
                $formatedResult[$fSessionStarted]['h_session_started_date'] = $this->getDateFromString($row['session_started'], true);
                $formatedResult[$fSessionStarted]['h_session_finished_date'] = $this->getDateFromString($row['session_finished'], true);                  $formatedResult[$fSessionStarted]['session_started_date'] = $this->getDateFromString($row['session_started']);
                $formatedResult[$fSessionStarted]['session_finished_date'] = $this->getDateFromString($row['session_finished']);                $formatedResult[$fSessionStarted]['h_session_started_hour'] = $this->getHourFromString($row['session_started'], true);
                $formatedResult[$fSessionStarted]['h_session_finished_hour'] = $this->getHourFromString($row['session_finished'], true);
                $formatedResult[$fSessionStarted]['session_started_hour'] = $this->getHourFromString($row['session_started']);
                $formatedResult[$fSessionStarted]['session_finished_hour'] = $this->getHourFromString($row['session_finished']);
                $formatedResult[$fSessionStarted]['session_started'] = $row['session_started'];
                $formatedResult[$fSessionStarted]['courses'][] = $row;
            }else{
                $formatedResult[$fSessionStarted]['courses'][] = $row;
            }
        }

        return $formatedResult;
    }
    
    public function getCourseModuleFilePath($courseId)
    {
        $courseObj = $this->entityManager
                ->getRepository("WikusamaWikufestAppBundle:Course")->findOneBy(
                    ["id" => $courseId]
                );      
        
        if($courseObj->getIsModuleFileDownloadable()){
            return $courseObj->getModuleFilePath();
        }else{
            // module file is not allow to download
            return false;
        }
    }
    
    public function registerAudienceToCourseSession($userId, $courseSessionId)
    {
        if($this->isAudienceCanChooseCourses)
        {
            $sql = "INSERT INTO `audience_course_sessions`(`audience`, `course_session_id`, `date_created`) 
                        VALUES (:user_id,:course_session_id,CURRENT_TIMESTAMP)";
            
            $this->dbConnection->executeQuery($sql, [
                "user_id" => $userId,
                "course_session_id" => $courseSessionId
            ]);
            
            return true;
        }else{
            // Audience can't choose courses because of config value not allow
            // so return false
            return false;
        }        
    }
    
    public function denyAllModuleFileDownload()
    {
        $this->dbConnection->executeQuery(
            $this->queryUpdateModuleFileDownloadable(),
            [
               "is_module_file_downloadable" => 0 
            ]
        )
        ;
    }
    
    public function allowAllModuleFileDownload()
    {
        $this->dbConnection->executeQuery(
            $this->queryUpdateModuleFileDownloadable(),
            [
               "is_module_file_downloadable" => 1 
            ]
        )
        ;
    }
    
    private function queryUpdateModuleFileDownloadable()
    {
        return "UPDATE `courses` SET `is_module_file_downloadable`=:is_module_file_downloadable";
    }

    private function combineDateString($dateString)
    {
        return str_replace([":", "-", " "], "", $dateString);
    }
    
    private function getDateFromString($dateString, $isHumanize = false)
    {
        $dateObj = new \DateTime($dateString);
        
        if($isHumanize){
            return $dateObj->format('d F Y');
        }else{
            return $dateObj->format('Y-m-d');
        }
    }
    
    private function getHourFromString($dateTimeString, $isHumanize = false)
    {
        $dateObj = new \DateTime($dateTimeString);
        
        if($isHumanize){
            return $dateObj->format('h:i');
        }else{
            return $dateObj->format('h:i:s');
        }
    }
    
}