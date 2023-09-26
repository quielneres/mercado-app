<?php

namespace controllers;

use PHPUnit\Framework\TestCase;

class HomeControllerTest extends TestCase
{
    public function testGreetsWithName(): void
    {
        $greeter = new \app\controllers\HomeController();

        $greeting = $greeter->greet('Alice');

        $this->assertSame('Hello, Alice!', $greeting);
    }
}