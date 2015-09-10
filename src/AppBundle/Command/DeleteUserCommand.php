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
use Symfony\Component\Console\Question\Question;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * A command console that deletes users and from the database.
 * To use this command, open a terminal window, enter into your project
 * directory and execute the following:
 *
 *     $ php app/console app:delete-user
 *
 * To output detailed information, increase the command verbosity:
 *
 *     $ php app/console app:delete-user -vv
 *
 * See http://symfony.com/doc/current/cookbook/console/console_command.html
 *
 * @author Oleg Voronkovich <oleg-voronkovich@yandex.ru>
 */
class DeleteUserCommand extends ContainerAwareCommand
{
    const MAX_ATTEMPTS = 5;

    /**
     * @var ObjectManager
     */
    private $em;

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            // a good practice is to use the 'app:' prefix to group all your custom application commands
            ->setName('app:delete-user')
            ->setDescription('Deletes users from the database')
            ->setHelp($this->getCommandHelp())
            // commands can optionally define arguments and/or options (mandatory and optional)
            // see http://symfony.com/doc/current/components/console/console_arguments.html
            ->addArgument('userIdentity', InputArgument::OPTIONAL, 'The username or email of an existing user')
        ;
    }

    /**
     * This method is executed before the interact() and the execute() methods.
     * It's main purpose is to initialize the variables used in the rest of the
     * command methods.
     *
     * Beware that the input options and arguments are validated after executing
     * the interact() method, so you can't blindly trust their values in this method.
     */
    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->em = $this->getContainer()->get('doctrine')->getManager();
    }

    /**
     * This method is executed after initialize() and before execute(). Its purpose
     * is to check if some of the options/arguments are missing and interactively
     * ask the user for those values.
     *
     * This method is completely optional. If you are developing an internal console
     * command, you probably should not implement this method because it requires
     * quite a lot of work. However, if the command is meant to be used by external
     * users, this method is a nice way to fall back and prevent errors.
     */
    protected function interact(InputInterface $input, OutputInterface $output)
    {
        if (null !== $input->getArgument('userIdentity')) {
            return;
        }

        // multi-line messages can be displayed this way...
        $output->writeln('');
        $output->writeln('Delete User Command Interactive Wizard');
        $output->writeln('-----------------------------------');

        // ...but you can also pass an array of strings to the writeln() method
        $output->writeln(array(
            '',
            'If you prefer to not use this interactive wizard, provide the',
            'arguments required by this command as follows:',
            '',
            ' $ php app/console app:delete-user username or email',
            '',
        ));

        $output->writeln(array(
            '',
            'Now we\'ll ask you for the value of all the missing command arguments.',
            '',
        ));

        // See http://symfony.com/doc/current/components/console/helpers/questionhelper.html
        $console = $this->getHelper('question');

        $userIdentity = $input->getArgument('userIdentity');
        if (null === $userIdentity) {
            $question = new Question(' > <info>Username or email</info>: ');
            $question->setValidator(array($this, 'userIdentityValidator'));
            $question->setMaxAttempts(self::MAX_ATTEMPTS);

            $userIdentity = $console->ask($input, $output, $question);
            $input->setArgument('userIdentity', $userIdentity);
        } else {
            $output->writeln(' > <info>Username or email</info>: ' . $userIdentity);
        }
    }

    /**
     * This method is executed after interact() and initialize(). It usually
     * contains the logic to execute to complete this command task.
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $startTime = microtime(true);

        $userIdentity = $input->getArgument('userIdentity');

        $this->userIdentityValidator($userIdentity);

        $user = null;
        $repository = $this->em->getRepository('AppBundle:User');

        if (false !== strpos($userIdentity, '@')) {
            $identityType = 'email';
            $user = $repository->findOneBy(array('email' => $userIdentity));
        } else {
            $identityType = 'username';
            $user = $repository->findOneBy(array('username' => $userIdentity));
        }

        if (null === $user) {
            throw new \RuntimeException(sprintf('User with %s "%s" not found.', $identityType, $userIdentity));
        }

        $userId = $user->getId();

        $this->em->remove($user);
        $this->em->flush();

        $output->writeln('');
        $output->writeln(sprintf('[OK] User "%s" (ID: %d, email: %s) was successfully deleted.', $user->getUsername(), $userId, $user->getEmail()));

        if ($output->isVerbose()) {
            $finishTime = microtime(true);
            $elapsedTime = $finishTime - $startTime;

            $output->writeln(sprintf('[INFO] Elapsed time: %.2f ms', $elapsedTime*1000));
        }
    }

    /**
     * This internal method should be private, but it's declared as public to
     * maintain PHP 5.3 compatibility when using it in a callback.
     *
     * @internal
     */
    public function userIdentityValidator($userIdentity)
    {
        if (empty($userIdentity)) {
            throw new \Exception('The value can not be empty');
        }

        if (1 !== preg_match('/^[\da-z_@\.]+$/', $userIdentity)) {
            throw new \Exception('It must be a valid username or email');
        }

        return $userIdentity;
    }

    /**
     * The command help is usually included in the configure() method, but when
     * it's too long, it's better to define a separate method to maintain the
     * code readability.
     */
    private function getCommandHelp()
    {
        return <<<HELP
The <info>%command.name%</info> command deletes users from the database:

  <info>php %command.full_name%</info> <comment>username or email</comment>

If you omit the argmument, the command will ask you to
provide the missing value:

  # command will ask you for the argument
  <info>php %command.full_name%</info>

HELP;
    }
}
