<?php declare(strict_types=1);
namespace Belin\Should;

use PHPUnit\Framework\{Assert, ExpectationFailedException, TestCase};
use PHPUnit\Framework\Attributes\{Test, TestDox};

/**
 * Tests the features of the {@see Should} class.
 */
#[TestDox("Should")]
class ShouldTests extends TestCase {

	#[Test, TestDox("beEmpty()")]
	public function beEmpty(): void {
		$this->shouldNotThrow(fn() => "" |> Should::beEmpty());
		$this->shouldNotThrow(fn() => [] |> Should::beEmpty());
		$this->shouldThrow(fn() => "foo" |> Should::beEmpty());
		$this->shouldThrow(fn() => [""] |> Should::beEmpty());
	}

	/**
	 * Tests whether the specified action does not throw an `ExpectationFailedException`.
	 * @param callable $action The action to invoke.
	 */
	private static function shouldNotThrow(callable $action): void {
		try { $action(); Assert::assertTrue(true); } // @phpstan-ignore staticMethod.alreadyNarrowedType
		catch (\Throwable $ex) { Assert::assertNotInstanceOf(ExpectationFailedException::class, $ex); } // @phpstan-ignore staticMethod.impossibleType
	}

	/**
	 * Tests whether the specified action throws an `ExpectationFailedException` of the expected type.
	 * @param callable $action The action to invoke.
	 */
	private static function shouldThrow(callable $action): void {
		try { $action(); Assert::fail("The specified action did not throw any exception."); }
		catch (\Throwable $ex) { Assert::assertInstanceOf(ExpectationFailedException::class, $ex); }
	}
}
