<?php

/*
 *
 * (c) 2015 Okta Purnama Rahadian <okta.rahadian@hotmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Wikusama\Bundle\Wikufest\AppBundle\Controller\Course;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Response;

class RegisterAudienceToCourseSessionController extends Controller
{
    public function indexAction()
    {
        if(!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
            return new AccessDeniedException();
        }
        
		$error = null;
		$courseSessionList = $this->get('wikufest.course')->getFormatedCourses();
		
        return $this->render(
            'WikusamaWikufestAppBundle:Course/RegisterAudienceToCourseSession:registercourse.html.twig',
            array(
                'course_session_list' => $courseSessionList,
                'error' => $error,
            )
        );
    }
    
    public function processAction()
    {
        if(!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
            return new AccessDeniedException();
        }
        
        $userId = "";
        $courseSessionId = "";
        
        $this->get('wikufest.course')->registerAudienceToCourseSession($userId, $courseSessionId);
        
        return new Response("process");
    }
}