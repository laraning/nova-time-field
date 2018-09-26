# A time field for Laravel Nova applications

[![Latest Version on Packagist](https://img.shields.io/packagist/v/laraning/nova-time-field.svg?style=flat-square)](https://packagist.org/packages/laraning/nova-time-field)
[![StyleCI](https://github.styleci.io/repos/150501690/shield?branch=master)](https://github.styleci.io/repos/150501690)
[![Total Downloads](https://img.shields.io/packagist/dt/laraning/nova-time-field.svg?style=flat-square)](https://packagist.org/packages/laraning/nova-time-field)

This package contains a Nova field to allow you to store time values. Under the hood it uses the [flatpickr](https://github.com/flatpickr/flatpickr) default Laravel Nova Calendar library.

![screenshot of the nova time field](https://www.laraning.com/others/nova-time-field.png)

## Installation

You can install this package in your [Laravel Nova](https://nova.laravel.com) app via composer:

```bash
composer require laraning/nova-time-field
```

## Usage

You can use the `Laraning\NovaTimeField\TimeField` namespace in your Nova resource:

```php
namespace App\Nova;

use Laraning\NovaTimeField\TimeField;

class BlogPost extends Resource
{
    // ...

    public function fields(Request $request)
    {
        return [
            // ...

            TimeField::make('Post start Time'),
            // ...
        ];
    }
}
```

By default the time component uses a 24 hour format. Still you can make it in 12h format like:

```php
TimeField::make('Post start Time')->withTwelveHourTime(),
```
## Current development status

- [x] Make release 0.1.0.
- [ ] Add minimal test scenarios.
- [ ] Add timezone support.

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

