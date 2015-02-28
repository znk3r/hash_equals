<?php

/**
 * Unit test to verify the behaviour of hash_equals is the
 * same provided by the native function on PHP 5.6
 */
class HashEqualsTest extends PHPUnit_Framework_TestCase
{
    public function testFuncExists()
    {
        $this->assertTrue(function_exists('hash_equals'));
    }

    public function dataProviderEqual()
    {
        return array(
            array('hash', 'hash'),
            array('', ''),
        );
    }

    public function dataProviderNonEqual()
    {
        return array(
            array('hash1', 'hash2'),
            array('hash', 'a really long string'),
            array('a really long string', 'hash'),
            array('', 'hash'),
            array('hash', ''),
        );
    }

    public function dataProviderNonString()
    {
        return array(
            array(123, 'NaN'),
            array('NaN', 123),
            array(null, 123),
            array('123', 123),
            array(123, 123),
            array(null, ''),
            array(null, null),
        );
    }

    /**
     * @dataProvider dataProviderEqual
     */
    public function testEqualsTrue($knownString, $userString)
    {
        $this->assertTrue(hash_equals($knownString, $userString));
    }

    /**
     * @dataProvider dataProviderNonEqual
     */
    public function testEqualsFalse($knownString, $userString)
    {
        $this->assertFalse(hash_equals($knownString, $userString));
    }

    /**
     * @dataProvider dataProviderNonString
     */
    public function testNonStringEqualsTrue($knownString, $userString)
    {
        $this->assertfalse(@hash_equals($knownString, $userString));
    }

    /**
     * @dataProvider dataProviderNonString
     * @expectedException PHPUnit_Framework_Error_Warning
     */
    public function testNonStringWarning($knownString, $userString)
    {
        hash_equals($knownString, $userString);
    }
}