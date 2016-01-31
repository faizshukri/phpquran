PHP Quran
=========

PHP Quran was created by, and is maintained by [Faiz Shukri](https://github.com/faizshukri). This package allow developer to retrieve quran ayah and translation easily.

![PHP Quran](https://lh3.googleusercontent.com/ei0Yeh91ImHyXfdhZs49GYvn9dG_NNrInNAU-q77QzQCHUc2rvYn1yj0WHKB_BEobU7axk9-3bDL=w1200-h500-no)

[![Build Status](https://travis-ci.org/faizshukri/phpquran.svg)](https://travis-ci.org/faizshukri/phpquran)
[![Total Downloads](https://poser.pugx.org/faizshukri/phpquran/d/total.svg)](https://packagist.org/packages/faizshukri/phpquran)
[![Latest Stable Version](https://poser.pugx.org/faizshukri/phpquran/v/stable.svg)](https://packagist.org/packages/faizshukri/phpquran)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/faizshukri/phpquran/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/faizshukri/phpquran/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/faizshukri/phpquran/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/faizshukri/phpquran/?branch=master)
[![License](https://poser.pugx.org/faizshukri/phpquran/license.svg)](https://packagist.org/packages/faizshukri/phpquran)

## Installation

[PHP](https://php.net) 5.4+ is required.

This project can be installed via [Composer]:

``` bash
$ composer require faizshukri/phpquran
```

### Laravel Integration

PHP Quran has optional support for [Laravel](https://laravel.com) and comes with a Service Provider and Facades for easy integration.

After you have installed PHP Quran via Composer, open your Laravel config file `config/app.php` and add the following lines.

In the `$providers` array add the service providers for this package.

```php
FaizShukri\Quran\QuranServiceProvider::class
```

Add the facade of this package to the $aliases array.

```php
'Quran' => FaizShukri\Quran\Facades\Quran::class
```

Now the Quran Class will be auto-loaded by Laravel.

#### Configuration

PHP Quran supports optional configuration for Laravel.

To get started, you'll need to publish the config.

```bash
$ php artisan vendor:publish --provider="FaizShukri\Quran\QuranServiceProvider"
```

This will create a `config/quran.php` file in your app that you can modify to set your configuration. Also, make sure you check for changes to the original config file in this package between releases.

There are several config options:

**Storage Path**

By default, the app will download and store quran files in `storage/app/quran` directory. You may change the value to your own. However the path may be reside under `storage/app` directory.

**Translation**

Specify what translation you want to make available for use. Made sure you have added translation here before use in the code.


## Usage


## License

The PHP Quran code is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
