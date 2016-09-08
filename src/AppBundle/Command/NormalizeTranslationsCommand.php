<?php

namespace AppBundle\Command;

use AppBundle\Dumper\MyXliffFileDumper;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Translation\MessageCatalogue;

class NormalizeTranslationsCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:translations:normalize')
            ->setDescription('Normalize translations according to the default locale')
            ->addOption('all', null, InputOption::VALUE_NONE, 'Normalize all locales in application')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $defaultLocale = $this->getContainer()->getParameter('locale');
        $dumper = new MyXliffFileDumper();

        $supportedDomains = [
            'messages',
            'validators',
        ];

        foreach ($supportedDomains as $domain) {
            $defaultCatalogue = $this->loadCatalogue($domain, $defaultLocale);
            $this->dumpCatalogue($dumper, $defaultCatalogue);

            if ($input->getOption('all')) {
                foreach ($this->getAppLocales() as $locale) {
                    $catalogue = $this->loadCatalogue($domain, $locale);
                    $catalogue = $this->normalizeCatalogue($catalogue, $defaultCatalogue);
                    $this->dumpCatalogue($dumper, $catalogue);
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
                    // translation exists, just put it in right order
                    $normalizedCatalogue->set($key, $catalogue->get($key, $domain), $domain);
                } else {
                    // translation does NOT exist, put a TO DO with default message instead
                    $normalizedCatalogue->set($key, sprintf('@TODO Translate "%s" here', $value), $domain);
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
        $loader = $this->getContainer()->get('translation.loader.xliff');
        $translationsDir = $this->getContainer()->get('kernel')->getRootDir() . '/Resources/translations';

        $translationsPath = sprintf('%s/%s.%s.xliff', $translationsDir, $domain, $locale);

        return $loader->load($translationsPath, $locale, $domain);
    }

    /**
     * @param MyXliffFileDumper $dumper
     * @param MessageCatalogue $catalogue
     */
    private function dumpCatalogue(MyXliffFileDumper $dumper, MessageCatalogue $catalogue)
    {
        $translationsDir = $this->getContainer()->get('kernel')->getRootDir() . '/Resources/translations';
        $defaultLocale = $this->getContainer()->getParameter('locale');

        $dumper->dump($catalogue, [
            'path' => $translationsDir,
            'default_locale' => $defaultLocale,
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
