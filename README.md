# PHP Quran

PHP Quran was created and is maintained by [Faiz Shukri](https://github.com/faizshukri). This package allow developer to retrieve quran ayah and translation easily.

![PHP Quran](https://lh3.googleusercontent.com/ei0Yeh91ImHyXfdhZs49GYvn9dG_NNrInNAU-q77QzQCHUc2rvYn1yj0WHKB_BEobU7axk9-3bDL=w1200-h500-no)

[![PHPUnit](https://github.com/faizshukri/phpquran/actions/workflows/php.yml/badge.svg)](https://github.com/faizshukri/phpquran/actions/workflows/php.yml)
[![Total Downloads](https://poser.pugx.org/faizshukri/phpquran/d/total.svg)](https://packagist.org/packages/faizshukri/phpquran)
[![Latest Stable Version](https://poser.pugx.org/faizshukri/phpquran/v/stable.svg)](https://packagist.org/packages/faizshukri/phpquran)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/faizshukri/phpquran/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/faizshukri/phpquran/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/faizshukri/phpquran/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/faizshukri/phpquran/?branch=master)
[![License](https://poser.pugx.org/faizshukri/phpquran/license.svg)](https://packagist.org/packages/faizshukri/phpquran)

## Installation

[PHP](https://php.net) 5.6+/7+/8+ is required.

This project can be installed via [Composer]:

```bash
$ composer require faizshukri/phpquran
```

### Laravel Integration

PHP Quran has optional support for [Laravel](https://laravel.com) and comes with a Service Provider and Facades for easy integration.

Laravel version starting 5.5+ can use Package Auto-Discovery, so doesn't require you to manually add the ServiceProvider.

#### Laravel without auto-discovery

Open your Laravel config file `config/app.php` and add the following lines.

In the `$providers` array add the service providers for this package.

```php
FaizShukri\Quran\QuranServiceProvider::class
```

Add the facade of this package to the `$aliases` array.

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

1. `storage_path`

   By default, the app will download and store quran files in `storage/app/quran` directory. You may change the value to your own. However the path will be reside under `storage/app` directory.

2. `translations`

   Specify translations that you want to make available for use. Make sure you add translation here before use in the code.

3. `limit`

   Default limits per query are `15 ayah` and `3 translations`.

### Console

PHP Quran also ship a binary file to be used in console. You can access directly from `vendor/bin/quran`, or if you want to access it from anywhere, you can install PHP Quran globally and put your composer global directory path to your working environment's `$PATH`.

```bash
$ composer global require faizshukri/phpquran
```

## Usage

```php
use FaizShukri\Quran\Quran;

$quran = new Quran();

$quran->get('1:3');
// ٱلرَّحْمَٰنِ ٱلرَّحِيمِ

$quran->get('1:2,4-6');
// [
//   2 => "ٱلْحَمْدُ لِلَّهِ رَبِّ ٱلْعَٰلَمِينَ",
//   4 => "مَٰلِكِ يَوْمِ ٱلدِّينِ",
//   5 => "إِيَّاكَ نَعْبُدُ وَإِيَّاكَ نَسْتَعِينُ",
//   6 => "ٱهْدِنَا ٱلصِّرَٰطَ ٱلْمُسْتَقِيمَ"
// ]

$quran->translation('en')->get('1:3');
// The Entirely Merciful, the Especially Merciful,

$quran->translation('ar,en')->get('1:3');
// [
//   "ar" => "ٱلرَّحْمَٰنِ ٱلرَّحِيمِ",
//   "en" => "The Entirely Merciful, the Especially Merciful,"
// ]

$quran->translation('ar,en')->get('1:2,3');
// [
//   "ar" => [
//     2 => "ٱلْحَمْدُ لِلَّهِ رَبِّ ٱلْعَٰلَمِينَ",
//     3 => "ٱلرَّحْمَٰنِ ٱلرَّحِيمِ"
//   ],
//   "en" => [
//     2 => "[All] praise is [due] to Allah, Lord of the worlds -",
//     3 => "The Entirely Merciful, the Especially Merciful,"
//   ]
// ]

```

### Console

PHP Quran can be used in console like this.

```bash

$ quran surah
# +------------------+-------------------+--------------------+-------------------+
# | All surah                                                                     |
# +------------------+-------------------+--------------------+-------------------+
# | 1. Al-Faatiha    | 30. Ar-Room       | 59. Al-Hashr       | 87. Al-A'laa      |
# | 2. Al-Baqara     | 31. Luqman        | 60. Al-Mumtahana   | 88. Al-Ghaashiya  |
# | 3. Aal-i-Imraan  | 32. As-Sajda      | 61. As-Saff        | 89. Al-Fajr       |
# ....

$ quran surah 1
#  =========== =============
#   Surah Al-Faatiha
#  =========== =============
#   Index       1
#   Name        Al-Faatiha
#   Name (ar)   الفاتحة
#   Meaning     The Opening
#   No. Ayah    7
#   Start       0
#   Type        Meccan
#   Order       5
#   Rukus       1
#  =========== =============

$ quran surah 1 2
# ٱلْحَمْدُ لِلَّهِ رَبِّ ٱلْعَٰلَمِينَ

$ quran surah 1 2,4-5 en
# [ 2 ]	[All] praise is [due] to Allah, Lord of the worlds -
# [ 4 ]	Sovereign of the Day of Recompense.
# [ 5 ]	It is You we worship and You we ask for help.

$ quran surah 1 2 ar,en
# [ AR ]	ٱلْحَمْدُ لِلَّهِ رَبِّ ٱلْعَٰلَمِينَ
# [ EN ]	[All] praise is [due] to Allah, Lord of the worlds -

$ quran surah 1 2-4 ar,en
#
# AR
# ====
#
# [ 2 ]	ٱلْحَمْدُ لِلَّهِ رَبِّ ٱلْعَٰلَمِينَ
# [ 3 ]	ٱلرَّحْمَٰنِ ٱلرَّحِيمِ
# [ 4 ]	مَٰلِكِ يَوْمِ ٱلدِّينِ
#
#
# EN
# ====
#
# [ 2 ]	[All] praise is [due] to Allah, Lord of the worlds -
# [ 3 ]	The Entirely Merciful, the Especially Merciful,
# [ 4 ]	Sovereign of the Day of Recompense.

```

#### Surah name

You can also specify surah by its name. If the surah specified cannot found, it will find the closest one first and will suggest to you if more than a surah is found.

```bash

$ quran surah baqara
#  =========== ===========
#   Surah Al-Baqara
#  =========== ===========
#   Index       2
#   Name        Al-Baqara
#   Name (ar)   البقرة
#   Meaning     The Cow
#   No. Ayah    286
#   Start       7
#   Type        Medinan
#   Order       87
#   Rukus       40
#  =========== ===========

$ quran surah nas 4
# No surah found. Did you mean one of the following?
#   [0] Yunus
#   [1] Abasa
#   [2] An-Nasr
#   [3] An-Naas
#  > 3

مِن شَرِّ ٱلْوَسْوَاسِ ٱلْخَنَّاسِ

```

#### Translation

Translation can also be configured via console. It will be saved in the configuration file. (run `quran config:path` to see where the file is located).

```bash

$ quran translation:add ms.basmeih
# Downloading translation ms.basmeih ...
# ms.basmeih has been added successfully.

$ quran translation:add
# Please specify a translation ID. You can refer to the table below.
#
# +------------+----------+---------------+--------------------+
# | ID         | Language | Name          | Translator         |
# +------------+----------+---------------+--------------------+
# | sq.nahi    | Albanian | Efendi Nahi   | Hasan Efendi Nahi  |
# | sq.mehdiu  | Albanian | Feti Mehdiu   | Feti Mehdiu        |
# | sq.ahmeti  | Albanian | Sherif Ahmeti | Sherif Ahmeti      |
# | ber.mensur | Amazigh  | At Mensur     | Ramdane At Mansour |
# |                                                            |
# | .... 113 more translations                                 |
# +------------+----------+---------------+--------------------+

$ quran translation:list
# Currently configured translations.
#   - en.sahih
#   - ms.basmeih
```

## Contributers

Thanks to the following people and organization for helping out this project;

| Name                                                      | Link                                     |
| --------------------------------------------------------- | ---------------------------------------- |
| ![Tanzil](http://tanzil.net/pub/spread/banner/tanzil.png) | [Tanzil.Net](http://tanzil.net)          |
| Hussaini Zulkifli                                         | [@hussaini](https://github.com/hussaini) |

## License

The PHP Quran code is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
