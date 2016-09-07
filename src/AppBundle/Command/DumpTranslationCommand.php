<?php

namespace AppBundle\Command;

use AppBundle\Dumper\MyXliffFileDumper;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

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
        $dumper = new MyXliffFileDumper();

        $defaultLocale = $this->getContainer()->getParameter('locale');
        $domains = [
            'messages',
            'validators',
        ];

        foreach ($domains as $domain) {
            $this->dump($dumper, $domain, $defaultLocale, $defaultLocale);

            foreach ($this->getAppLocales() as $locale) {
                $this->dump($dumper, $domain, $locale, $defaultLocale);
            }
        }
    }

    private function dump($dumper, $domain, $locale, $defaultLocale)
    {
        $loader = $this->getContainer()->get('translation.loader.xliff');
        $translationsDir = $this->getContainer()->get('kernel')->getRootDir() . '/Resources/translations';

        $translationsPath = sprintf('%s/%s.%s.xliff', $translationsDir, $domain, $locale);
        $defaultCatalogue = $loader->load($translationsPath, $locale, $domain);

        $dumper->dump($defaultCatalogue, [
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
