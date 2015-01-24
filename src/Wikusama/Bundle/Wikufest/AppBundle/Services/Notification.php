<?php

/*
 *
 * (c) 2015 Okta Purnama Rahadian <okta.rahadian@hotmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Wikusama\Bundle\Wikufest\AppBundle\Services;

use Symfony\Bundle\TwigBundle\Debug\TimedTwigEngine;
use Doctrine\ORM\EntityManager;

class Notification
{
    protected $mailer;
    protected $templating;
    protected $defaultFromAddress;
    
    public function __construct($defaultFromAddress, \Swift_Mailer $mailer, TimedTwigEngine $templating)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
        $this->defaultFromAddress = $defaultFromAddress;
    }
    
    public function userAccountActivation($emailTo, $name ,$username, $password)
    {
        $subject = "Wikufest account activation";
        
        $body = $this->templating->render(
                                'WikusamaWikufestAppBundle:MailTemplates:user_account_activation.html.twig',
                                array(
                                    "name" => $name,
                                    "username" => $username,
                                    "password" => $password
                                )
                            );
        
        $message = \Swift_Message::newInstance()
                        ->setSubject($subject)
                        ->setFrom($this->defaultFromAddress)
                        ->setTo($emailTo)
                        ->setBody(
                            $body
                        )
                    ;
                   
        $this->mailer->send($message);
    }
}