<?php /** @noinspection ALL */

namespace MortenScheel\LaravelMacros\Mixins;

use Illuminate\Support\Collection;

class CollectionMixin
{
    public function sortKeysRecursively(): \Closure
    {
        /**
         * @instantiated
         * @param int $options
         * @param bool $descending
         * @return \Illuminate\Support\Collection
         */
        return function (bool $descending = false): Collection {
            $sortMethod = $descending ? 'sortKeysDesc' : 'sortKeys';
            $items = $descending ? $this->sortKeysDesc()->all() : $this->sortKeys()->all();
            foreach ($items as $key => $value) {
                if (is_array($value)) {
                    $items[$key] = (new static($value))->sortKeysRecursively($descending)->all();
                }
            }

            return new static($items);
        };
    }
}
