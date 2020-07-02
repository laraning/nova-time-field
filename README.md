# A time field for Laravel Nova applications

[![Latest Version on Packagist](https://img.shields.io/packagist/v/laraning/nova-time-field.svg?style=flat-square)](https://packagist.org/packages/laraning/nova-time-field)
[![StyleCI](https://github.styleci.io/repos/150501690/shield?branch=master)](https://github.styleci.io/repos/150501690)
[![Total Downloads](https://img.shields.io/packagist/dt/laraning/nova-time-field.svg?style=flat-square)](https://packagist.org/packages/laraning/nova-time-field)

This package contains a Nova field to allow you to store time values. Under the hood it uses the [flatpickr](https://github.com/flatpickr/flatpickr) default Laravel Nova Calendar library.

![screenshot of the nova time field](https://assets.waygou.com/nova-time-field.jpg)

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

You can also change the default 5 minute increments to another number:

```php
TimeField::make('Post start Time')->minuteIncrement(1),
```

You can make sure that all times entered are converted back to your base app timezone (set in `config/app.php`) by calling
the `withTimezoneAdjustments()` method on your field.

```php
TimeField::make('Post start Time')->withTimezoneAdjustments(),
```

An example of this would be when your app is set to GMT but your user is in BST (GMT+1). The user would still be able to 
interact with the timefield in their local time, but the time would be saved into the database in GMT.

E.G. The user may select 14:00. They will always see the time as 14:00, but the database will save it as 13:00 as it makes 
the BST -> GMT adjustments behind the scenes.

## Current development status

- [x] Make release 0.1.0.
- [ ] Add minimal test scenarios.
- [x] Add timezone support.

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

