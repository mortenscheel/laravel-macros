<?php

namespace MortenScheel\LaravelMacros\Mixins;

class FilesystemMixin
{
    public function modify(): \Closure
    {
        /**
         * @instantiated
         * @param string $path
         * @param \Closure $callback
         * @return bool|int
         */
        return function (string $path, \Closure $callback) {
            return $this->put($path, $callback($this->get($path)));
        };
    }
}
