<?php

namespace AppBundle\Composer;

use Composer\Script\CommandEvent;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Class ScriptHandler
 * @author Victor Bocharsky <bocharsky.bw@gmail.com>
 */
class ScriptHandler
{
    /**
     * Rename Symfony SE default "config.php" script to "check.php"
     * which used in Symfony Demo to unsure application requirements.
     *
     * @param CommandEvent $event
     */
    public static function handleCheckScript(CommandEvent $event)
    {
        $options = $event->getComposer()->getPackage()->getExtra();

        $rootDir = getcwd();
        $appDir = $options['symfony-app-dir'];
        $filename = $rootDir . DIRECTORY_SEPARATOR . $appDir. DIRECTORY_SEPARATOR . 'check.php';

        $fs = new Filesystem();
        if ($fs->exists($filename)) {
            $content = file_get_contents($filename);
            $content = str_replace('web/config.php', 'web/check.php', $content);
            $fs->dumpFile($filename, $content);
            unset($content);
        }
    }
}
