<?php

namespace MortenScheel\LaravelMacros\Mixins;

use Illuminate\Http\Response;

class ResponseMixin
{
    public function plain(): \Closure
    {
        /**
         * @param $body
         * @return \Illuminate\Http\Response
         */
        return function ($body): Response {
            return \Response::make($body)
                ->header('Content-Type', 'text/plain;charset=UTF-8');
        };
    }
}
