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
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class RegisterAudienceToCourseSessionController extends Controller
{
    public function indexAction()
    {
		$error = null;
		$courseSessionList = $this->get('wikufest.course')->getFormatedCourses(
            $this->get('security.context')->getToken()->getUser()->getId()
        );
        
        $userProfile = $this->getDoctrine()->getEntityManager()
                            ->getRepository('WikusamaWikufestAppBundle:UserProfile')->loadUserProfileByUsername(
            $this->get('security.context')->getToken()->getUser()->getUsername()
        );
		
        return $this->render(
            'WikusamaWikufestAppBundle:Course/RegisterAudienceToCourseSession:registercourse.html.twig',
            array(
                'course_session_list' => $courseSessionList,
                'error' => $error,
                'user_profile' => $userProfile
            )
        );
    }
    
    public function processAction(Request $request)
    {
        $userId = $this->get('security.context')->getToken()->getUser()->getId();
        $courseSessionId = $request->request->get('course_session_id');
        
        $isSuccess = $this->get('wikufest.course')->registerAudienceToCourseSession($userId, $courseSessionId);
        
        return new JsonResponse(["is_success" => $isSuccess]);
    }
}