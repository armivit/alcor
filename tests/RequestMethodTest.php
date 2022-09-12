<?php

declare(strict_types=1);

namespace App;

use PHPUnit\Framework\TestCase;

class RequestMethodTest extends TestCase
{
    /**
     * @dataProvider methodNamesProvider
     */
    public function testExtract(string $methodName): void
    {
        $value = RequestMethod::extract($methodName);

        $this->assertIsInt($value);

        $any = RequestMethod::any();

        $this->assertTrue(($any & $value) === $value);

        $any &= ~$value;

        $this->assertFalse(($any & $value) === $value);
    }

    public function testExtractNonExistent(): void
    {
        $this->assertNull(RequestMethod::extract('NON_EXISTENT_HTTP_METHOD'));
    }

    public function methodNamesProvider(): array
    {
        return [
            ['GET'],
            ['HEAD'],
            ['POST'],
            ['PUT'],
            ['DELETE'],
            ['CONNECT'],
            ['OPTIONS'],
            ['TRACE'],
            ['PATCH'],
        ];
    }
}
