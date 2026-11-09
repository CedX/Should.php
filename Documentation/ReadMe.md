# BDD assertions for PHPUnit
A thin [BDD](https://en.wikipedia.org/wiki/Behavior-driven_development) wrapper
around [PHPUnit](https://phpunit.de) assertions, for [PHP](https://www.php.net).

## Quick start
Install the latest version of **BDD assertions for PHPUnit** with [Composer](https://getcomposer.org) package manager:

```powershell
composer require cedx/should
```

For detailed instructions, see the [installation guide](Installation.md).

## Usage
Are you tired of writing your [PHPUnit](https://phpunit.de) assertions this way?

```php
use PHPUnit\Framework\TestCase;

$this->assertTrue($condition);
$this->assertEquals($expected, $actual);
$this->assertGreaterThan($lowerBound, $value);
$this->assertContains($value, $sequence);
$this->assertCount($expected, $sequence);
$this->assertStringEndsWith($suffix, $value);
$this->assertInstanceOf(\SplFileInfo::class, $value);
$this->expectException(\Exception::class);
```

Why not try this instead?

```php
use Belin\Should\Should;
use PHPUnit\Framework\TestCase;

$condition |> Should::beTrue();
$actual |> Should::be($expected);
$value |> Should::beGreaterThan($lowerBound);
$value |> Should::beOneOf($sequence);
$sequence |> count(...) |> Should::be($expected);
$value |> Should::endWith($suffix);
$value |> Should::beOfType(\SplFileInfo::class);
$action |> Should::throw(\Exception::class);
```

Much better! (Personal opinion)
