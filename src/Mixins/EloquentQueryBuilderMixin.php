<?php

namespace MortenScheel\LaravelMacros\Mixins;

class EloquentQueryBuilderMixin
{
    public function inlineQuery(): \Closure
    {
        /**
         * Get SQL string with binding values included.
         * Warning: Vulnerable to SQL injection attacks.
         * Should only be used for debugging purposes.
         *
         * @instantiated
         * @return string
         */
        return function (): string {
            return $this->getQuery()->inlineQuery();
        };
    }
}
