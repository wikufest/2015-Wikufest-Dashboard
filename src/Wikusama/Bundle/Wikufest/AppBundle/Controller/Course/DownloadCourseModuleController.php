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
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class RegisterAudienceToCourseSessionController extends Controller
{
    public function downloadAction()
    {
        if(!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
            return new AccessDeniedException();
        }
        
        $courseId = "";
        $path = $this->get('wikufest.course')->getCourseModuleFilePath($courseId);
        
        return new BinaryFileResponse($path);
    }
}