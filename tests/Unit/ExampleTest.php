<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
final class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function testThatTrueIsTrue(): void
    {
        // @phpstan-ignore staticMethod.alreadyNarrowedType
        self::assertTrue(true);
    }
}
