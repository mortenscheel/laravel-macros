# Laravel-Macros

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]

A collection of useful macros for Laravel. See details below.

## Installation

Via Composer

``` bash
$ composer require mortenscheel/laravel-macros
```

## Macros
### Carbon
`Carbon::upToNearest(int $minutes): Carbon`

Rounds up to the nearest minute divisible by `$minutes`

`Carbon::downToNearest(int $minutes): Carbon`

Rounds down to the nearest minute divisible by `$minutes`

### Note
If the original time is already divisible by `$minutes` and the seconds are exactly zero, no rounding will occur.


### Filesystem
`File::modify(string $path, \Closure $callback)`

The `$callback` will receive the current content of the file, and the return value will be stored back to the same `$path`

### Collection
`Collection::sortKeysRecursively(bool $descending = false): Collection`

Sorts the Collection by keys, recursively.

Useful for comparing nested associative arrays where the contents may be sorted differently.

### Response
`Response::plain($body): Response`

Convenient macro for returning a plain text response. Simply adds a`Content-Type: text/plain;charset=UTF-8` header

### Builder
`Builder::inlineQuery(): string`

Returns the Query SQL with bindings inserted. Useful for debugging queries, but should never be used in production.

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

``` bash
$ ./vendor/bin/phpunit
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email author email instead of using the issue tracker.

## Credits

- [Morten Scheel]([link-author])

## License

MIT license. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/mortenscheel/laravel-macros.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/mortenscheel/laravel-macros.svg?style=flat-square
[link-packagist]: https://packagist.org/packages/mortenscheel/laravel-macros
[link-downloads]: https://packagist.org/packages/mortenscheel/laravel-macros
[link-author]: https://github.com/mortenscheel
