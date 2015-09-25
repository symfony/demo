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
    private $entityManager;

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
            ->addArgument('username', InputArgument::REQUIRED, 'The username of an existing user')
        ;
    }

    /**
     * This method is executed before the interact() and the execute() methods.
     * Its main purpose is to initialize the variables used in the rest of the
     * command methods.
     *
     * Beware that the input options and arguments are validated after executing
     * the interact() method, so you can't blindly trust their values in this method.
     */
    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->entityManager = $this->getContainer()->get('doctrine')->getManager();
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
        if (null !== $input->getArgument('username')) {
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
            ' $ php app/console app:delete-user username',
            '',
        ));

        $output->writeln(array(
            '',
            'Now we\'ll ask you for the value of all the missing command arguments.',
            '',
        ));

        // See http://symfony.com/doc/current/components/console/helpers/questionhelper.html
        $helper = $this->getHelper('question');

        $question = new Question(' > <info>Username</info>: ');
        $question->setValidator(array($this, 'usernameValidator'));
        $question->setMaxAttempts(self::MAX_ATTEMPTS);

        $username = $helper->ask($input, $output, $question);
        $input->setArgument('username', $username);
    }

    /**
     * This method is executed after interact() and initialize(). It usually
     * contains the logic to complete this command task.
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $startTime = microtime(true);

        $username = $input->getArgument('username');

        $this->usernameValidator($username);

        $repository = $this->entityManager->getRepository('AppBundle:User');

        $user = $repository->findOneByUsername($username);

        if (null === $user) {
            throw new \RuntimeException(sprintf('User with username "%s" not found.', $username));
        }

        // After an entity has been removed its in-memory state is the same
        // as before the removal, except for generated identifiers.
        // See http://docs.doctrine-project.org/en/latest/reference/working-with-objects.html#removing-entities
        $userId = $user->getId();

        $this->entityManager->remove($user);
        $this->entityManager->flush();

        $output->writeln('');
        $output->writeln(sprintf('[OK] User "%s" (ID: %d, email: %s) was successfully deleted.', $user->getUsername(), $userId, $user->getEmail()));

        if ($output->isVerbose()) {
            $finishTime = microtime(true);
            $elapsedTime = $finishTime - $startTime;

            $output->writeln(sprintf('[INFO] Elapsed time: %.2f ms', $elapsedTime*1000));
        }
    }

    /**
     * This internal method should be private, but it's declared public to
     * maintain PHP 5.3 compatibility when using it in a callback.
     *
     * @internal
     */
    public function usernameValidator($username)
    {
        if (empty($username)) {
            throw new \Exception('The username can not be empty.');
        }

        if (1 !== preg_match('/^[a-z_]+$/', $username)) {
            throw new \Exception('The username must contain only lowercase latin characters and underscores.');
        }

        return $username;
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

  <info>php %command.full_name%</info> <comment>username</comment>

If you omit the argmument, the command will ask you to
provide the missing value:

  # command will ask you for the argument
  <info>php %command.full_name%</info>

HELP;
    }
}
