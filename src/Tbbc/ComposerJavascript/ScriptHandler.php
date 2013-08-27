<?php

namespace Tbbc\ComposerJavascript;

use Symfony\Component\ClassLoader\ClassCollectionLoader;
use Symfony\Component\Process\Process;
use Composer\Script\CommandEvent;

/**
 * @author Benjamin Dulau <benjamin.dulau@gmail.com>
 */
class ScriptHandler
{
    /**
     * @param $event CommandEvent A instance
     */
    public static function npmInstall(CommandEvent $event)
    {
        $options = self::getOptions($event);
        $symlink = $options['npm-bin-links'] ? '' : '--no-bin-links';

        static::executeCommand($event, 'npm install '.$symlink);
    }

    /**
     * @param $event CommandEvent A instance
     */
    public static function bowerInstall(CommandEvent $event)
    {
        static::executeCommand($event, 'bower install');
    }

    protected static function executeCommand(CommandEvent $event, $cmd, $timeout = 300)
    {
        $process = new Process($cmd, null, null, null, $timeout);
        $process->run(function ($type, $buffer) { echo $buffer; });
        if (!$process->isSuccessful()) {
            throw new \RuntimeException(sprintf('An error occurred when executing the "%s" command.', escapeshellarg($cmd)));
        }
    }

    protected static function getOptions(CommandEvent $event)
    {
        $extras = $event->getComposer()->getPackage()->getExtra();
        $options = isset($extras['tbbc-composer-javascript']) ? $extras['tbbc-composer-javascript'] : array();

        $options = array_merge(array(
            'npm-bin-links' => true,
            'process-timeout' => $event->getComposer()->getConfig()->get('process-timeout'),
        ), $options);

        return $options;
    }
}
