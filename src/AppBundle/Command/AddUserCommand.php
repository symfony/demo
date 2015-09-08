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
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;

/**
 * A command console that creates users and stores them in the database.
 * To use this command, open a terminal window, enter into your project
 * directory and execute the following:
 *
 *     $ php app/console app:add-user
 *
 * To output detailed information, increase the command verbosity:
 *
 *     $ php app/console app:add-user -vv
 *
 * See http://symfony.com/doc/current/cookbook/console/console_command.html
 *
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 */
class AddUserCommand extends ContainerAwareCommand
{
    const MAX_ATTEMPTS = 5;

    /**
     * @var ObjectManager
     */
    private $entityManager;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            // a good practice is to use the 'app:' prefix to group all your custom application commands
            ->setName('app:add-user')
            ->setDescription('Creates users and stores them in the database')
            ->setHelp($this->getCommandHelp())
            // commands can optionally define arguments and/or options (mandatory and optional)
            // see http://symfony.com/doc/current/components/console/console_arguments.html
            ->addArgument('username', InputArgument::OPTIONAL, 'The username of the new user')
            ->addArgument('password', InputArgument::OPTIONAL, 'The plain password of the new user')
            ->addArgument('email', InputArgument::OPTIONAL, 'The email of the new user')
            ->addOption('is-admin', null, InputOption::VALUE_NONE, 'If set, the user is created as an administrator')
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
        $this->entityManager = $this->getContainer()->get('doctrine')->getManager();
        $this->validator = $this->getContainer()->get('validator');
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
        if (null !== $input->getArgument('username') && null !== $input->getArgument('password') && null !== $input->getArgument('email')) {
            return;
        }

        // multi-line messages can be displayed this way...
        $output->writeln('');
        $output->writeln('Add User Command Interactive Wizard');
        $output->writeln('-----------------------------------');

        // ...but you can also pass an array of strings to the writeln() method
        $output->writeln(array(
            '',
            'If you prefer to not use this interactive wizard, provide the',
            'arguments required by this command as follows:',
            '',
            ' $ php app/console app:add-user username password email@example.com',
            '',
        ));

        $output->writeln(array(
            '',
            'Now we\'ll ask you for the value of all the missing command arguments.',
            '',
        ));

        // See http://symfony.com/doc/current/components/console/helpers/questionhelper.html
        $console = $this->getHelper('question');

        $properties = array(
            'username'      => array('argName' => 'username', 'hidden' => false),
            'plainPassword' => array('argName' => 'password', 'hidden' => true),
            'email'         => array('argName' => 'email',    'hidden' => false),
        );

        // Ask for the property if it's not defined
        foreach ($properties as $property => $settings) {
            $argName = $settings['argName'];
            $argValue = $input->getArgument($argName);
            $hidden = $settings['hidden'];

            if (null === $argValue) {
                $question = new Question(sprintf(' > <info>%s</info>%s: ',
                    ucfirst($argName),
                    $hidden ? ' (your type will be hidden)' : ''
                ));
                $question->setValidator($this->getValidatorForProperty($property));
                $question->setHidden($hidden);
                $question->setMaxAttempts(self::MAX_ATTEMPTS);

                $argValue = $console->ask($input, $output, $question);
                $input->setArgument($argName, $argValue);
            } else {
                $output->writeln(sprintf(' > <info>%s</info>: %s', ucfirst($argName), $argValue));
            }
        }
    }

    /**
     * This method is executed after interact() and initialize(). It usually
     * contains the logic to execute to complete this command task.
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $startTime = microtime(true);

        $username = $input->getArgument('username');
        $plainPassword = $input->getArgument('password');
        $email = $input->getArgument('email');
        $isAdmin = $input->getOption('is-admin');

        // create the user and encode its password
        $user = new User();
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setRoles(array($isAdmin ? 'ROLE_ADMIN' : 'ROLE_USER'));
        $user->setPlainPassword($plainPassword);

        // See http://symfony.com/doc/current/book/validation.html
        $errors = $this->validator->validate($user, null, array('Default', 'registration'));

        if (0 < count($errors)) {
            $output->writeln('');
            foreach ($errors as $error) {
                $property = 'plainPassword' === $error->getPropertyPath() ? 'password' : $error->getPropertyPath();
                $output->writeln(sprintf('<error>[%s] %s</error>', $property, $error->getMessage()));
            }
            return;
        }

        // Plain password no more needed in the model
        $user->eraseCredentials();

        // See http://symfony.com/doc/current/book/security.html#security-encoding-password
        $encoder = $this->getContainer()->get('security.password_encoder');
        $encodedPassword = $encoder->encodePassword($user, $plainPassword);
        $user->setPassword($encodedPassword);

        $this->em->persist($user);
        $this->em->flush($user);

        $output->writeln('');
        $output->writeln(sprintf('[OK] %s was successfully created: %s (%s)', $isAdmin ? 'Administrator user' : 'User', $user->getUsername(), $user->getEmail()));

        if ($output->isVerbose()) {
            $finishTime = microtime(true);
            $elapsedTime = $finishTime - $startTime;

            $output->writeln(sprintf('[INFO] New user database id: %d / Elapsed time: %.2f ms', $user->getId(), $elapsedTime*1000));
        }
    }

    private function getValidatorForProperty($property)
    {
        $validator = $this->validator;

        return function($value) use ($validator, $property) {
            $errors = $validator->validatePropertyValue('\AppBundle\Entity\User', $property, $value, array('Default', 'registration'));

            if (0 < count($errors)) {
                $message = '';

                foreach ($errors as $error) {
                    $message .= sprintf(' %s', $error->getMessage());
                }

                throw new \Exception(sprintf('[%s] %s', $property, $message));
            }

            return $value;
        };
    }

    /**
     * The command help is usually included in the configure() method, but when
     * it's too long, it's better to define a separate method to maintain the
     * code readability.
     */
    private function getCommandHelp()
    {
        return <<<HELP
The <info>%command.name%</info> command creates new users and saves them in the database:

  <info>php %command.full_name%</info> <comment>username password email</comment>

By default the command creates regular users. To create administrator users,
add the <comment>--is-admin</comment> option:

  <info>php %command.full_name%</info> username password email <comment>--is-admin</comment>

If you omit any of the three required arguments, the command will ask you to
provide the missing values:

  # command will ask you for the email
  <info>php %command.full_name%</info> <comment>username password</comment>

  # command will ask you for the email and password
  <info>php %command.full_name%</info> <comment>username</comment>

  # command will ask you for all arguments
  <info>php %command.full_name%</info>

HELP;
    }
}
