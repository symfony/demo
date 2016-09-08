<?php

namespace AppBundle\Command;

use AppBundle\Dumper\AppXliffFileDumper;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Translation\Loader\XliffFileLoader;
use Symfony\Component\Translation\MessageCatalogue;

class NormalizeTranslationsCommand extends ContainerAwareCommand
{
    /**
     * @var bool
     */
    private $isAllOptionSet;

    /**
     * @var bool
     */
    private $isAppendOptionSet;

    /**
     * @var string
     */
    private $defaultLocale;

    /**
     * @var string
     */
    private $translationsDir;

    /**
     * @var XliffFileLoader
     */
    private $loader;

    /**
     * @var AppXliffFileDumper
     */
    private $dumper;

    protected function configure()
    {
        $this
            ->setName('app:translations:normalize')
            ->setDescription('Normalize translations according to the default locale')
            ->addOption('all', null, InputOption::VALUE_NONE, 'Normalize all locales in application')
            ->addOption('append', null, InputOption::VALUE_NONE, 'Append TODO about missed translations')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->isAllOptionSet = $input->getOption('all');
        $this->isAppendOptionSet = $input->getOption('append');
        $this->defaultLocale = $this->getContainer()->getParameter('locale');
        $this->translationsDir = $this->getContainer()->get('kernel')->getRootDir() . '/Resources/translations';
        $this->loader = $this->getContainer()->get('translation.loader.xliff');
        $this->dumper = $this->getContainer()->get('app.translation.dumper.xliff');

        $supportedDomains = [
            'messages',
            'validators',
        ];

        foreach ($supportedDomains as $domain) {
            $defaultCatalogue = $this->loadCatalogue($domain, $this->defaultLocale);
            $this->dumpCatalogue($defaultCatalogue);

            if ($this->isAllOptionSet) {
                foreach ($this->getAppLocales() as $locale) {
                    $catalogue = $this->loadCatalogue($domain, $locale);
                    $catalogue = $this->normalizeCatalogue($catalogue, $defaultCatalogue);
                    $this->dumpCatalogue($catalogue);
                }
            }
        }
    }

    /**
     * Normalize message catalog according to the default one
     *
     * @param MessageCatalogue $catalogue
     * @param MessageCatalogue $defaultCatalogue
     *
     * @return MessageCatalogue
     */
    private function normalizeCatalogue(MessageCatalogue $catalogue, MessageCatalogue $defaultCatalogue)
    {
        $normalizedCatalogue = new MessageCatalogue($catalogue->getLocale());

        foreach ($catalogue->getDomains() as $domain) {
            // Iterate over all messages in the default catalogue
            foreach ($defaultCatalogue->all($domain) as $key => $value) {
                if ($catalogue->defines($key, $domain)) {
                    // Translation exists, just put it in right order
                    $normalizedCatalogue->set($key, $catalogue->get($key, $domain), $domain);
                } else {
                    // Translation does NOT exist...
                    if ($this->isAppendOptionSet) {
                        // Put a TO DO with default message for missed translation
                        $normalizedCatalogue->set($key, sprintf('@TODO Translate "%s" here', $value), $domain);
                    }
                }
            }
        }

        return $normalizedCatalogue;
    }

    /**
     * @param string $domain
     * @param string $locale
     *
     * @return MessageCatalogue
     */
    private function loadCatalogue($domain, $locale)
    {
        $filePath = sprintf('%s/%s.%s.xliff', $this->translationsDir, $domain, $locale);

        return $this->loader->load($filePath, $locale, $domain);
    }

    /**
     * @param MessageCatalogue $catalogue
     */
    private function dumpCatalogue(MessageCatalogue $catalogue)
    {
        $this->dumper->dump($catalogue, [
            'path' => $this->translationsDir,
            'default_locale' => $this->defaultLocale,
        ]);
    }

    /**
     * @TODO Remove default locale from this list?
     *
     * @return string[]
     */
    private function getAppLocales()
    {
        $locales = $this->getContainer()->getParameter('app_locales');
        $locales = trim($locales, '|');

        return explode('|', $locales);
    }
}
