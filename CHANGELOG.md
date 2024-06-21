# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

## [3.0.0] - 2024-06-21

### Removed

- Class `Ghostwriter\Clock\Exception\CannotChangeTimezoneOfFrozenClockException` removed
- Class `Ghostwriter\Clock\Interface\ClockExceptionInterface` removed
- Class `Ghostwriter\Clock\Trait\ClockTrait` removed
- Method `Ghostwriter\Clock\Interface\ClockInterface::withDateTimeZone()` removed
- Method `Ghostwriter\Clock\Interface\ClockInterface::withSystemTimezone()` removed
- Method `Ghostwriter\Clock\Interface\ClockInterface::withTimezone()` removed
- Method `Ghostwriter\Clock\FrozenClock::withDateTimeZone()` removed
- Method `Ghostwriter\Clock\FrozenClock::withSystemTimezone()` removed
- Method `Ghostwriter\Clock\FrozenClock::withTimezone()` removed
- Method `Ghostwriter\Clock\LocalizedClock::withDateTimeZone()` removed
- Method `Ghostwriter\Clock\LocalizedClock::withSystemTimezone()` removed
- Method `Ghostwriter\Clock\LocalizedClock::withTimezone()` removed
- Method `Ghostwriter\Clock\SystemClock::withDateTimeZone()` removed
- Method `Ghostwriter\Clock\SystemClock::withSystemTimezone()` removed
- Method `Ghostwriter\Clock\SystemClock::withTimezone()` removed

## [2.0.0] - 2023-12-16

### Added

- Method freeze() was added to interface Ghostwriter\Clock\Interface\ClockInterface
- Method freeze() was added to interface Ghostwriter\Clock\Interface\FrozenClockInterface
- Method freeze() was added to interface Ghostwriter\Clock\Interface\LocalizedClockInterface
- Method freeze() was added to interface Ghostwriter\Clock\Interface\SystemClockInterface
- Method new() was added to interface Ghostwriter\Clock\Interface\FrozenClockInterface
- Method new() was added to interface Ghostwriter\Clock\Interface\LocalizedClockInterface
- Method new() was added to interface Ghostwriter\Clock\Interface\SystemClockInterface
- Method withDateTimeZone() was added to interface Ghostwriter\Clock\Interface\ClockInterface
- Method withDateTimeZone() was added to interface Ghostwriter\Clock\Interface\FrozenClockInterface
- Method withDateTimeZone() was added to interface Ghostwriter\Clock\Interface\LocalizedClockInterface
- Method withDateTimeZone() was added to interface Ghostwriter\Clock\Interface\SystemClockInterface
- Method withSystemTimezone() was added to interface Ghostwriter\Clock\Interface\ClockInterface
- Method withSystemTimezone() was added to interface Ghostwriter\Clock\Interface\FrozenClockInterface
- Method withSystemTimezone() was added to interface Ghostwriter\Clock\Interface\LocalizedClockInterface
- Method withSystemTimezone() was added to interface Ghostwriter\Clock\Interface\SystemClockInterface
- Method withTimezone() was added to interface Ghostwriter\Clock\Interface\ClockInterface
- Method withTimezone() was added to interface Ghostwriter\Clock\Interface\FrozenClockInterface
- Method withTimezone() was added to interface Ghostwriter\Clock\Interface\LocalizedClockInterface
- Method withTimezone() was added to interface Ghostwriter\Clock\Interface\SystemClockInterface

### Changed

- Method __construct() of class Ghostwriter\Clock\FrozenClock visibility reduced from public to private
- Method __construct() of class Ghostwriter\Clock\LocalizedClock visibility reduced from public to private
- Method freeze() of class Ghostwriter\Clock\Trait\ClockTrait changed from concrete to abstract
- Method now() of class Ghostwriter\Clock\Trait\ClockTrait changed from concrete to abstract
- Method withDateTimeZone() of class Ghostwriter\Clock\Trait\ClockTrait changed scope from static to instance
- Method withDateTimeZone() of class Ghostwriter\Clock\Trait\ClockTrait changed scope from static to instance
- Method withDateTimeZone() of class Ghostwriter\Clock\Trait\ClockTrait changed scope from static to instance
- Method withDateTimeZone() of class Ghostwriter\Clock\Trait\ClockTrait changed scope from static to instance
- Method withSystemTimezone() of class Ghostwriter\Clock\Trait\ClockTrait changed scope from static to instance
- Method withSystemTimezone() of class Ghostwriter\Clock\Trait\ClockTrait changed scope from static to instance
- Method withSystemTimezone() of class Ghostwriter\Clock\Trait\ClockTrait changed scope from static to instance
- Method withSystemTimezone() of class Ghostwriter\Clock\Trait\ClockTrait changed scope from static to instance
- Method withTimezone() of class Ghostwriter\Clock\Trait\ClockTrait changed scope from static to instance
- Method withTimezone() of class Ghostwriter\Clock\Trait\ClockTrait changed scope from static to instance
- Method withTimezone() of class Ghostwriter\Clock\Trait\ClockTrait changed scope from static to instance
- Method withTimezone() of class Ghostwriter\Clock\Trait\ClockTrait changed scope from static to instance
- The number of required arguments for Ghostwriter\Clock\FrozenClock#__construct() increased from 0 to 1
- The number of required arguments for Ghostwriter\Clock\LocalizedClock#__construct() increased from 0 to 1

### Removed

- Class Ghostwriter\Clock\Exception\UnsupportedClockException has been deleted
- Method Ghostwriter\Clock\FrozenClock#__construct() was removed
- Method Ghostwriter\Clock\LocalizedClock#__construct() was removed
- Method Ghostwriter\Clock\SystemClock::create() was removed

## 1.1.0 - 2023-09-28

- Use constructor injection

## 1.0.0 - 2023-09-28

- First version
