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

use AppBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

/**
 * A console command that deletes users from the database.
 *
 * To use this command, open a terminal window, enter into your project
 * directory and execute the following:
 *
 *     $ php bin/console app:delete-user
 *
 * Check out the code of the src/AppBundle/Command/AddUserCommand.php file for
 * the full explanation about Symfony commands.
 *
 * See https://symfony.com/doc/current/cookbook/console/console_command.html
 * For more advanced uses, commands can be defined as services too. See
 * https://symfony.com/doc/current/console/commands_as_services.html
 *
 * @author Oleg Voronkovich <oleg-voronkovich@yandex.ru>
 */
class DeleteUserCommand extends Command
{
    const MAX_ATTEMPTS = 5;

    private $entityManager;

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();

        $this->entityManager = $em;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('app:delete-user')
            ->setDescription('Deletes users from the database')
            ->addArgument('username', InputArgument::REQUIRED, 'The username of an existing user')
            ->setHelp(<<<'HELP'
The <info>%command.name%</info> command deletes users from the database:

  <info>php %command.full_name%</info> <comment>username</comment>

If you omit the argument, the command will ask you to
provide the missing value:

  <info>php %command.full_name%</info>
HELP
            );
    }

    protected function interact(InputInterface $input, OutputInterface $output)
    {
        if (null !== $input->getArgument('username')) {
            return;
        }

        $output->writeln('');
        $output->writeln('Delete User Command Interactive Wizard');
        $output->writeln('-----------------------------------');

        $output->writeln([
            '',
            'If you prefer to not use this interactive wizard, provide the',
            'arguments required by this command as follows:',
            '',
            ' $ php bin/console app:delete-user username',
            '',
        ]);

        $output->writeln([
            '',
            'Now we\'ll ask you for the value of all the missing command arguments.',
            '',
        ]);

        $helper = $this->getHelper('question');

        $question = new Question(' > <info>Username</info>: ');
        $question->setValidator([$this->getContainer()->get('app.validator'), 'validateUsername']);
        $question->setMaxAttempts(self::MAX_ATTEMPTS);

        $username = $helper->ask($input, $output, $question);
        $input->setArgument('username', $username);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $validator = $this->getContainer()->get('app.validator');
        $username = $validator->validateUsername($input->getArgument('username'));

        $repository = $this->entityManager->getRepository(User::class);
        /** @var User $user */
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
    }
}
