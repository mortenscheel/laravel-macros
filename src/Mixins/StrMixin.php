<?php

namespace MortenScheel\LaravelMacros\Mixins;


class StrMixin
{
    /**
     * Get ordinal suffix for a number (st/nd/rd/th)
     * @return \Closure
     */
    public function ordinalSuffix(): \Closure
    {
        /**
         * @param int $number
         * @return string
         */
        return static function($number): string {
            $int = abs((int) $number);
            $suffixes = ['th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th'];
            if ((($int % 100) >= 11) && (($int % 100) <= 13)) {
                return 'th';
            }

            return $suffixes[$int % 10];
        };
    }
}
