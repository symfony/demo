<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use AppBundle\Entity\User;

/**
 * Creates users and stores them in the database
 *
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 */
class AddUserCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:add-user')
            ->setDescription('Creates users and stores them in the database')
            ->addArgument('username', InputArgument::REQUIRED, 'The username of the new user')
            ->addArgument('password', InputArgument::REQUIRED, 'The plain password of the new user')
            ->addArgument('email', InputArgument::REQUIRED, 'The email of the new user')
            ->addOption('is-admin', null, InputOption::VALUE_NONE, 'If set, the user is created as an administrator')
        ;
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->em = $this->getContainer()->get('doctrine')->getManager();

        $this->username = $input->getArgument('username');
        $this->plainPassword = $input->getArgument('password');
        $this->email = $input->getArgument('email');
        $this->isAdmin = $input->getOption('is-admin');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // first check if a user with the same username already exists
        $existingUser = $this->em->getRepository('AppBundle:User')->findOneBy(array(
            'username' => $input->getArgument('username')
        ));

        if (null !== $existingUser) {
            throw new \RuntimeException(sprintf('There is already a user registered with the "%s" username.', $this->username));

        }

        // create the user and encode its password
        $user = new User();
        $user->setUsername($this->username);
        $user->setEmail($this->email);
        $user->setRoles(array($this->isAdmin ? 'ROLE_ADMIN' : 'ROLE_USER'));

        // See http://symfony.com/doc/current/book/security.html#security-encoding-password
        $encoder = $this->getContainer()->get('security.password_encoder');
        $encodedPassword = $encoder->encodePassword($user, $this->plainPassword);
        $user->setPassword($encodedPassword);

        $this->em->persist($user);
        $this->em->flush($user);

        $output->writeln(sprintf('User was successfully created: %s (%s)', $user->getUsername(), $user->getEmail()));
    }
}
