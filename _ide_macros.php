<?php

namespace Illuminate\Support {
    class Carbon
    {
        /**
         * @instantiated
         * @param int $minute
         * @return \Illuminate\Support\Carbon
         */
        public function downToNearest(int $minute): \Illuminate\Support\Carbon
        {

        }

        /**
         * @instantiated
         * @param int $minute
         * @return \Illuminate\Support\Carbon
         */
        public function upToNearest(int $minute): \Illuminate\Support\Carbon
        {

        }
    }
}

namespace Carbon {
    class Carbon
    {
        /**
         * @instantiated
         * @param int $minute
         * @return \Illuminate\Support\Carbon
         */
        public function downToNearest(int $minute): \Illuminate\Support\Carbon
        {

        }

        /**
         * @instantiated
         * @param int $minute
         * @return \Illuminate\Support\Carbon
         */
        public function upToNearest(int $minute): \Illuminate\Support\Carbon
        {

        }
    }
}

namespace Illuminate\Support {
    class Collection
    {
        /**
         * @instantiated
         * @param int $options
         * @param bool $descending
         * @return \Illuminate\Support\Collection
         */
        public function sortKeysRecursively(bool $descending = false): \Illuminate\Support\Collection
        {

        }
    }
}

namespace Illuminate\Filesystem {
    class Filesystem
    {
        /**
         * @instantiated
         * @param string $path
         * @param \Closure $callback
         * @return bool|int
         */
        public function modify(string $path, \Closure $callback)
        {

        }
    }
}

namespace Illuminate\Database\Query {
    class Builder
    {
        /**
         * Get SQL string with binding values included.
         * Warning: Vulnerable to SQL injection attacks.
         * Should only be used for debugging purposes.
         *
         * @instantiated
         * @return string
         */
        public function inlineQuery(): string
        {

        }
    }
}

namespace Illuminate\Http {
    class Response
    {
        /**
         * @param $body
         * @return \Illuminate\Http\Response
         */
        public static function plain($body): \Illuminate\Http\Response
        {

        }
    }
}
