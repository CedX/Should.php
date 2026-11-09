<?php declare(strict_types=1);
namespace Belin\Should;

use PHPUnit\Framework\{Assert, ExpectationFailedException, TestCase};
use PHPUnit\Framework\Attributes\{Test, TestDox};

/**
 * Tests the features of the {@see Should} class.
 */
#[TestDox("Should")]
class ShouldTests extends TestCase {

	#[Test, TestDox("be()")]
	public function be(): void {
		self::shouldSucceed(fn() => true |> Should::be(true));
		self::shouldSucceed(fn() => 123 |> Should::be(123));
		self::shouldSucceed(fn() => "foo" |> Should::be("foo"));

		self::shouldFail(fn() => false |> Should::be(true));
		self::shouldFail(fn() => 456 |> Should::be(123));
		self::shouldFail(fn() => "bar" |> Should::be("foo"));
	}

	#[Test, TestDox("beEmpty()")]
	public function beEmpty(): void {
		self::shouldSucceed(fn() => "" |> Should::beEmpty());
		self::shouldSucceed(fn() => [] |> Should::beEmpty());

		self::shouldFail(fn() => "foo" |> Should::beEmpty());
		self::shouldFail(fn() => [""] |> Should::beEmpty());
	}

	#[Test, TestDox("beOfType()")]
	public function beOfType(): void {
    self::shouldSucceed(fn() => false |> Should::beOfType("bool"));
    self::shouldSucceed(fn() => "123" |> Should::beOfType("string"));
    self::shouldSucceed(fn() => 123 |> Should::beOfType("int"));
    self::shouldSucceed(fn() => new \DateTime |> Should::beOfType(\DateTimeInterface::class));

    self::shouldFail(fn() => 0 |> Should::beOfType("bool"));
    self::shouldFail(fn() => "123" |> Should::beOfType("int"));
    self::shouldFail(fn() => 123 |> Should::beOfType("string"));
    self::shouldFail(fn() => new \stdClass |> Should::beOfType(\DateTimeInterface::class));
	}

	/**
	 * Tests whether the specified action throws an `ExpectationFailedException` of the expected type.
	 * @param callable $action The action to invoke.
	 */
	private static function shouldFail(callable $action): void {
		try { $action(); Assert::fail("The specified action did not throw any exception."); }
		catch (\Throwable $ex) { Assert::assertInstanceOf(ExpectationFailedException::class, $ex); }
	}

	/**
	 * Tests whether the specified action does not throw an `ExpectationFailedException`.
	 * @param callable $action The action to invoke.
	 */
	private static function shouldSucceed(callable $action): void {
		try { $action(); Assert::assertTrue(true); } // @phpstan-ignore staticMethod.alreadyNarrowedType
		catch (\Throwable $ex) { Assert::assertNotInstanceOf(ExpectationFailedException::class, $ex); }
	}
}
