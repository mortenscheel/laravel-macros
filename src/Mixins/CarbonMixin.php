<?php

namespace MortenScheel\LaravelMacros\Mixins;

use Illuminate\Support\Carbon;

class CarbonMixin
{
    public function downToNearest(): \Closure
    {
        /**
         * @instantiated
         * @param int $minute
         * @return \Illuminate\Support\Carbon
         */
        return function (int $minute): Carbon {
            $mod = $this->minute % $minute;
            return $this->setSecond()
                ->setMicro(0)
                ->subMinutes($mod);
        };
    }

    public function upToNearest(): \Closure
    {
        /**
         * @instantiated
         * @param int $minute
         * @return \Illuminate\Support\Carbon
         */
        return function (int $minute): Carbon {
            $diff = $minute - $this->minute;
            $mod = ($diff % $minute) % $minute;
            if ($mod === 0 && $this->second > 0) {
                $mod = $minute;
            }
            return $this
                ->setSecond(0)
                ->setMicro(0)
                ->addMinutes($mod);
        };
    }
}
