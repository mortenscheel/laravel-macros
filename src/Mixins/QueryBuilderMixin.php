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
            $pdo = app('db')->connection()->getPdo();
            $bindings = collect($this->getBindings())->map(function($value) use ($pdo) {
                if ($value instanceof \DateTimeInterface) {
                    $value = $value->format('Y-m-d H:i:s');
                }

                return $pdo->quote($value);
            })->toArray();

            return \Illuminate\Support\Str::replaceArray('?', $bindings, $sql);
        };
    }
}
