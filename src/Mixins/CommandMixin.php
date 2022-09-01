<?php

namespace MortenScheel\LaravelMacros\Mixins;

use Symfony\Component\Console\Helper\ProgressBar;

class CommandMixin
{
    /**
     * Create a ProgressBar with debug information
     * @return \Closure
     */
    public function createDebugProgressBar(): \Closure
    {
        /**
         * @param int|null $count
         * @return ProgressBar
         */
        return function($count = null): ProgressBar {
            $progress = $this->getOutput()->createProgressBar($count);
            if ($count === null) {
                return $progress; // Debug info requires knowing the count
            }
            $progress->setFormat('debug');

            return $progress;
        };
    }
}
