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
        $loader = $this->getContainer()->get('translation.loader.xliff');
        $dumper = new MyXliffFileDumper();

        $locale = 'en';
        $domain = 'messages';
        $translationsDir = $this->getContainer()->get('kernel')->getRootDir() . '/Resources/translations';
        $translationsPath = sprintf('%s/%s.%s.xliff', $translationsDir, $domain, $locale);

        $catalogue = $loader->load($translationsPath, $locale, $domain);

        $dumper->dump($catalogue, [
            'path' => $translationsDir,
            'default_locale' => $locale,
        ]);
    }
}
