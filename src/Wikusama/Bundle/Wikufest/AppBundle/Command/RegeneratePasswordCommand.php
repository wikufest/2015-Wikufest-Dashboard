<?php

/*
 *
 * (c) 2015 Okta Purnama Rahadian <okta.rahadian@hotmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
namespace Wikusama\Bundle\Wikufest\AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RegeneratePasswordCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('Wikufest:RegeneratePassword')
            ->setDescription('Generate all password')
            ->addArgument(
                'output',
                InputArgument::OPTIONAL,
                'Output csv file'
            )
        ;
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $outputFilePath = $input->getArgument('output');
        $entityManager = $this->getContainer()->get('doctrine')->getManager();
        
        $csvFile = fopen($outputFilePath, 'w');
        $users = $entityManager->getRepository('WikusamaWikufestAppBundle:User')->loadAll();
        
        foreach($users as $u)
        {
            $newPassword = $this->getContainer()->get('wikufest.user_account')->generateRandomPassword();
            /**
            $this->getContainer()->get('wikufest.user_account')->changeUserPassword($u['username'], $newPassword);
            fputcsv($csvFile, [$u['username'],$['up_fullname'] ,$['up_student_class_name'], $newPassword]);
            */
        }
        
        fclose($csvFile);
    }
}
