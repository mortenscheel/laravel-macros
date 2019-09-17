<?php

namespace MortenScheel\LaravelMacros\Mixins;

class QueryBuilderMixin
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
            $sql = $this->toSql();
            $bindings = collect($this->getBindings())->map(function ($value) {
                return sprintf("'%s'", $value instanceof \DateTime ? $value->format('Y-m-d H:i:s') : $value);
            })->toArray();

            return \Illuminate\Support\Str::replaceArray('?', $bindings, $sql);
        };
    }
}
