<?php 
/*
 *
 * (c) 2015 Okta Purnama Rahadian <okta.rahadian@hotmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Wikusama\Bundle\Wikufest\AppBundle\Controller\UserAccount;
 
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class CreateUserAccountController extends Controller
{
    public function loadFromFileAction()
    {
        if(!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
            return new AccessDeniedException();
        }
        
        // this is for initial purpose
        $file = "C:\wamp\www\Wikufest-Dashboard/Student.csv";
        $this->get('wikufest.user_account')->bulkCreateFromCsv($file);
        
        return new Response("Created");
        
    }
}