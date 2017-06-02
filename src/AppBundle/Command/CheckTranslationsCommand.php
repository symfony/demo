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
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Translation\DataCollectorTranslator;

/**
 * Class CheckTranslationsCommand.
 */
class CheckTranslationsCommand extends ContainerAwareCommand
{
    /**
     * This command uses the SymfonyStyle class which has a lot of helpful methods
     * to style the console output, including tables and progress bars.
     *
     * @see http://symfony.com/doc/current/console/style.html
     * @see http://api.symfony.com/3.2/Symfony/Component/Console/Style/SymfonyStyle.html
     *
     * @var SymfonyStyle
     */
    private $io = null;

    /**
     * @var DataCollectorTranslator
     */
    private $translator;

    private $locales = [];

    private $fallbackLocale = '';

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('app:check-translations')
            ->setDescription('Check translation files against the default translation file.')
            ->addArgument('locale', InputArgument::OPTIONAL, 'The locale to check');
    }

    /**
     * {@inheritdoc}
     */
    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->locales = explode('|', $this->getContainer()->getParameter('app_locales'));
        $this->fallbackLocale = 'en';
        $this->translator = $this->getContainer()->get('translator');
        $this->io = new SymfonyStyle($input, $output);

        $this->translator->setLocale($this->fallbackLocale);
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->io->title('Check translation files');

        $locale = $input->getArgument('locale');

        if ($locale) {
            if (false === in_array($locale, $this->locales)) {
                throw new \UnexpectedValueException(
                    ' The given locale does not exist. Valid locale: '.implode(', ', $this->locales)
                );
            }
            $this->check($locale);
        } else {
            $this->checkAll();
        }
    }

    private function checkAll()
    {
        $fallbackMessages = $this->translator->getCatalogue()->all();

        $checks = [];

        foreach ($this->locales as $locale) {
            if ($locale === $this->fallbackLocale) {
                continue;
            }

            $check = [];

            $check['Locale'] = $locale;
            $check['Missing'] = 0;
            $check['Superfluous'] = 0;

            $catalogue = $this->translator->getCatalogue($locale)->all();

            foreach ($catalogue as $domain => $messages) {
                $check['Missing'] += count(array_diff_key($fallbackMessages[$domain], $messages));
                $check['Superfluous'] += count(array_diff_key($messages, $fallbackMessages[$domain]));
            }

            $checks[] = $check;
        }

        $this->io->text(sprintf('Fallback locale: <info>%s</info>', $this->fallbackLocale));
        $this->io->table(array_keys($checks[0]), $checks);
    }

    private function check($locale)
    {
        $fallbackMessages = $this->translator->getCatalogue()->all();
        $localeMessages = $this->translator->getCatalogue($locale)->all();

        $missingStrings = [];

        foreach ($fallbackMessages as $domain => $messages) {
            if (false === array_key_exists($domain, $localeMessages)) {
                $this->io->error(sprintf('The domain "%s" does not exist for locales "%s"', $domain, $locale));
                continue;
            }
            $diff = array_diff_key($messages, $localeMessages[$domain]);
            foreach ($diff as $key => $fallback) {
                $missingStrings[] = [$domain, $key, $fallback];
            }
        }

        $this->io->text(sprintf('Checking locale: <info>%s</info>', $locale));
        $this->io->text(sprintf('Fallback locale: <info>%s</info>', $this->fallbackLocale));

        if ($missingStrings) {
            $this->io->text(sprintf('Missing strings: <info>%d</info>', count($missingStrings)));
            $this->io->table(['Domain', 'Key', 'Fallback Message'], $missingStrings);
        } else {
            $this->io->success('Everything is translated.');
        }
    }
}
