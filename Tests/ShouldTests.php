<?php declare(strict_types=1);
namespace Belin\Should;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\{Test, TestDox};

/**
 * Tests the features of the {@see Should} class.
 */
#[TestDox("Should")]
class ShouldTests extends TestCase {

	#[Test, TestDox("TODO()")]
	public function TODO(): void {
		// TODO
	}
}
