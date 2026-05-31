# Clock

[![Automation](https://github.com/ghostwriter/clock/actions/workflows/automation.yml/badge.svg)](https://github.com/ghostwriter/clock/actions/workflows/automation.yml)
[![PHP Version](https://badgen.net/packagist/php/ghostwriter/clock?color=777BB4)](https://www.php.net/supported-versions)
[![Packagist Downloads](https://badgen.net/packagist/dt/ghostwriter/clock?color=F28D1A)](https://packagist.org/packages/ghostwriter/clock)
[![PayPal](https://img.shields.io/badge/paypal-@codepoet-0079C1?logo=data%3Aimage%2Fsvg%2Bxml%3Bbase64%2CPHN2ZyB2aWV3Qm94PSIwIDAgMjQgMjQiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI%2BPHBhdGggZD0iTTE5LjcxNSA2LjEzM2MuMjQ5LTEuODY2IDAtMy4xMS0uOTk5LTQuMjY2QzE3LjYzNC42MjIgMTUuNzIxIDAgMTMuMzA3IDBINi4yMzVjLS40MTggMC0uOTE2LjQ0NC0xIC44ODlMMi4zMjMgMjAuNjIyYzAgLjM1Ni4yNS44LjY2NS44aDQuMzI4bC0uMjUgMS45NTZjLS4wODQuMzU1LjE2Ni42MjIuNDk4LjYyMmgzLjY2M2MuNDE3IDAgLjgzMi0uMjY3LjkxNS0uNzExdi0uMjY3bC43NDktNC42MjJ2LS4xNzhjLjA4My0uNDQ0LjUtLjguOTE1LS44aC41YzMuNTc4IDAgNi4zMjUtMS41MSA3LjE1Ni01Ljk1NS40MTgtMS44NjcuMjUyLTMuMzc4LS43NDctNC40NDUtLjI1LS4zNTUtLjY2Ni0uNjIyLTEtLjg4OSIgZmlsbD0iIzAwOWNkZSIvPjxwYXRoIGQ9Ik0xOS43MTUgNi4xMzNjLjI0OS0xLjg2NiAwLTMuMTEtLjk5OS00LjI2NkMxNy42MzQuNjIyIDE1LjcyMSAwIDEzLjMwNyAwSDYuMjM1Yy0uNDE4IDAtLjkxNi40NDQtMSAuODg5TDIuMzIzIDIwLjYyMmMwIC4zNTYuMjUuOC42NjUuOGg0LjMyOGwxLjE2NC03LjM3OC0uMDgzLjI2N2MuMDg0LS41MzMuNS0uODg5Ljk5OC0uODg5aDIuMDhjNC4wNzkgMCA3LjI0MS0xLjc3OCA4LjI0LTYuNzU1LS4wODMtLjI2NyAwLS4zNTYgMC0uNTM0IiBmaWxsPSIjMDEyMTY5Ii8%2BPHBhdGggZD0iTTkuNTYzIDYuMTMzYy4wODItLjI2Ni4yNS0uNTMzLjQ5OC0uNzEuMTY2IDAgLjI1LS4wOS40MTYtLjA5aDUuNDk0Yy42NjYgMCAxLjMzLjA5IDEuODMuMTc4LjE2NiAwIC4zMzMgMCAuNDk4LjA4OS4xNjguMDg5LjMzNC4wODkuNDE4LjE3OGguMjVjLjI0OC4wODkuNDk3LjI2Ni43NDguMzU1LjI0OC0xLjg2NiAwLTMuMTEtLjk5OS00LjM1NUMxNy43MTcuNTMzIDE1LjgwNCAwIDEzLjM5IDBINi4yMzVjLS40MTggMC0uOTE2LjM1Ni0xIC44ODlMMi4zMjMgMjAuNjIyYzAgLjM1Ni4yNS44LjY2NS44aDQuMzI4bDEuMTY0LTcuMzc4IDEuMDg0LTcuOTF6IiBmaWxsPSIjMDAzMDg3Ii8%2BPC9zdmc%2B)](https://paypal.me/codepoet)
[![Sponsors via GitHub](https://img.shields.io/github/sponsors/ghostwriter?label=Sponsor+@ghostwriter/clock&logo=GitHub+Sponsors)](https://github.com/sponsors/ghostwriter)

Provides an immutable Clock implementation for PHP

## Installation

You can install the package via composer:

``` bash
composer require ghostwriter/clock
```

### Star ⭐️ this repo if you find it useful

You can also star (🌟) this repo to find it easier later.

### Usage

``` php
<?php

// Internally uses SystemClock::new(new DateTimeZone(date_default_timezone_get()));

date_default_timezone_set('America/Los_Angeles');
$systemClock = SystemClock::new();
$systemClock->now(); // DateTimeImmutable
$systemClock->now()->getTimezone()->getName(); // America/Los_Angeles

date_default_timezone_set('America/New_York');
$systemClock = SystemClock::new();
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
