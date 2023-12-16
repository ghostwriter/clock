# Clock

[![Compliance](https://github.com/ghostwriter/clock/actions/workflows/compliance.yml/badge.svg)](https://github.com/ghostwriter/clock/actions/workflows/compliance.yml)
[![Supported PHP Version](https://badgen.net/packagist/php/ghostwriter/clock?color=8892bf)](https://www.php.net/supported-versions)
[![GitHub Sponsors](https://img.shields.io/github/sponsors/ghostwriter?label=Sponsor+@ghostwriter/clock&logo=GitHub+Sponsors)](https://github.com/sponsors/ghostwriter)
[![Code Coverage](https://codecov.io/gh/ghostwriter/clock/branch/main/graph/badge.svg)](https://codecov.io/gh/ghostwriter/clock)
[![Type Coverage](https://shepherd.dev/github/ghostwriter/clock/coverage.svg)](https://shepherd.dev/github/ghostwriter/clock)
[![Latest Version on Packagist](https://badgen.net/packagist/v/ghostwriter/clock)](https://packagist.org/packages/ghostwriter/clock)
[![Downloads](https://badgen.net/packagist/dt/ghostwriter/clock?color=blue)](https://packagist.org/packages/ghostwriter/clock)

Provides an immutable Clock implementation for PHP

## Installation

You can install the package via composer:

``` bash
composer require ghostwriter/clock
```

### Usage

``` php
<?php

date_default_timezone_set('America/Los_Angeles');
$systemClock = SystemClock::new();
$systemClock->now(); // DateTimeImmutable
$systemClock->now()->getTimezone()->getName(); // America/Los_Angeles

date_default_timezone_set('America/New_York');
$systemClock = SystemClock::new(new DateTimeZone(date_default_timezone_get()));
$systemClock->now(); // DateTimeImmutable
$systemClock->now()->getTimezone()->getName(); // America/New_York

$localizedClock = LocalizedClock::new();
$localizedClock->now(); // DateTimeImmutable
$localizedClock->now()->getTimezone()->getName(); // UTC

$localizedClock = LocalizedClock::new(new DateTimeZone('Africa/Addis_Ababa'));
$localizedClock->now(); // DateTimeImmutable
$localizedClock->now()->getTimezone()->getName(); // Africa/Addis_Ababa

$frozenClock = FrozenClock::new(new DateTimeImmutable('now', new DateTimeZone('UTC')));
$frozenClock->now(); // DateTimeImmutable
$frozenClock->now()->getTimezone()->getName(); // UTC
```

### API

``` php
interface ClockInterface
{
    public function freeze(): FrozenClockInterface;

    public function now(): DateTimeImmutable;

    public function withDateTimeZone(DateTimeZone $dateTimeZone): LocalizedClockInterface;

    public function withSystemTimezone(): LocalizedClockInterface;

    public function withTimezone(string $timezone): LocalizedClockInterface;
}

interface FrozenClockInterface extends ClockInterface
{
    public static function new(DateTimeImmutable $dateTimeImmutable): self;
}

interface LocalizedClockInterface extends ClockInterface
{
    public static function new(DateTimeZone $dateTimeZone): self;
}

interface SystemClockInterface extends ClockInterface
{
    public static function new(): self;
}
```

### Changelog

Please see [CHANGELOG.md](./CHANGELOG.md) for more information what has changed recently.

### Security

If you discover any security related issues, please email `nathanael.esayeas@protonmail.com` or create a [Security Advisory](https://github.com/ghostwriter/clock/security/advisories/new) instead of using the issue tracker.

## License

The BSD-3-Clause. Please see [License File](./LICENSE) for more information.
