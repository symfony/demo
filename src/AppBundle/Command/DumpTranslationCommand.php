<?php

namespace AppBundle\Command;

use AppBundle\Dumper\MyXliffFileDumper;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Translation\MessageCatalogue;

class DumpTranslationCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:translation:dump')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $defaultLocale = $this->getContainer()->getParameter('locale');
        $dumper = new MyXliffFileDumper();

        $domains = [
            'messages',
            'validators',
        ];

        foreach ($domains as $domain) {
            $defaultCatalogue = $this->loadCatalogue($domain, $defaultLocale);
            $this->dumpCatalogue($dumper, $defaultCatalogue);

            foreach ($this->getAppLocales() as $locale) {
                $catalogue = $this->loadCatalogue($domain, $locale);
                $catalogue = $this->diffCatalogue($catalogue, $defaultCatalogue);
                $this->dumpCatalogue($dumper, $catalogue);
            }
        }
    }

    private function diffCatalogue(MessageCatalogue $catalogue, MessageCatalogue $defaultCatalogue)
    {
        // @TODO Reorder catalog according to the default one

        return $catalogue;
    }

    private function loadCatalogue($domain, $locale)
    {
        $loader = $this->getContainer()->get('translation.loader.xliff');
        $translationsDir = $this->getContainer()->get('kernel')->getRootDir() . '/Resources/translations';

        $translationsPath = sprintf('%s/%s.%s.xliff', $translationsDir, $domain, $locale);
        return $loader->load($translationsPath, $locale, $domain);
    }

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
