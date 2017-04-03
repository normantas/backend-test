<?php

namespace SamKnows\BackendTest;

use PHPUnit_Framework_TestCase;

class UnitTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function canConvertedToString()
    {
        $this->assertEquals("hello", (new Unit('hello'))->__toString());
    }
}
