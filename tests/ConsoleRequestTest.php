<?php

declare(strict_types=1);

namespace App;

use PHPUnit\Framework\TestCase;

class ConsoleRequestTest extends TestCase
{
    public function testMethod(): void
    {
        $request = new ConsoleRequest('-GET', '--foo-bar');
        $method = $request->getMethod();
        $path = $request->getPath();

        $this->assertEquals(RequestMethod::GET, $method);
        $this->assertArrayHasKey(0, $path);
        $this->assertEquals('foo', $path[0]);
        $this->assertArrayHasKey(1, $path);
        $this->assertEquals('bar', $path[1]);

        $request = new ConsoleRequest('-NET', '-foo-bar');
        $method = $request->getMethod();
        $path = $request->getPath();

        $this->assertEquals(RequestMethod::console(), $method);
        $this->assertEmpty($path);
    }
}
