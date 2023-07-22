<?php

namespace IdeasOnPurpose\WP\Admin;

use IdeasOnPurpose\WP\Test;
use PHPUnit\Framework\TestCase;

Test\Stubs::init();

/**
 * @covers \IdeasOnPurpose\WP\Admin\Separators
 */
final class SeparatorsTest extends TestCase
{
    public function setUp(): void
    {
        global $actions, $menu;

        $actions = [];
        $menu = [];
    }

    public function testInsertOneSeparator()
    {
        global $actions;
        new Separators(23);
        $expected = [23];

        $this->assertEquals($expected, $actions[0]['action'][0]->seps);
    }

    public function testInsertTwoSeparators()
    {
        $Seps = new Separators(25, 26);
        $expected = [25, 26];

        $this->assertCount(count($expected), $Seps->seps);
        $this->assertEquals($expected, $Seps->seps);
    }

    public function testInsertMixedSeparators()
    {
        $Seps = new Separators(25, '26', [27, '28']);
        $expected = [25, 26, 27, 28];

        $this->assertCount(count($expected), $Seps->seps);
        $this->assertEquals($expected, $Seps->seps);
    }

    public function testInsertMixedDuplicates()
    {
        $Seps = new Separators(25, '25', '26', 26);
        $expected = [25, 26];

        $this->assertCount(count($expected), $Seps->seps);
        $this->assertEquals($expected, $Seps->seps);
    }

    public function testInsertSeparatorsArray()
    {
        $Seps = new Separators([25, 26]);
        $expected = [25, 26];

        $this->assertCount(count($expected), $Seps->seps);
        $this->assertEquals($expected, $Seps->seps);
    }

    public function testInsertMixedSeparatorsArray()
    {
        $Seps = new Separators(22, [23, 24, [25], 26.123]);
        $expected = [22, 23, 24, 25, 26.123];

        $this->assertCount(count($expected), $Seps->seps);
        $this->assertEquals($expected, $Seps->seps);
    }

    public function testNoArgs()
    {
        $Seps = new Separators();
        $expected = [];

        $this->assertCount(0, $Seps->seps);
        $this->assertEquals($expected, $Seps->seps);
    }

    public function testRemoveDuplicates()
    {
        $Seps = new Separators(22, 23, 23, 24);
        $expected = [22, 23, 24];

        $this->assertCount(count($expected), $Seps->seps);
        $this->assertEquals($expected, $Seps->seps);
    }

    public function testRemoveDuplicatesArray()
    {
        $Seps = new Separators(22, [23, 23, 24]);
        $expected = [22, 23, 24];

        $this->assertCount(count($expected), $Seps->seps);
        $this->assertEquals($expected, $Seps->seps);
    }

    public function testSkipNonNumericArgs()
    {
        $Seps = new Separators(22, 'Stella', 23);
        $expected = [22, 23];

        $this->assertCount(count($expected), $Seps->seps);
        $this->assertEquals($expected, $Seps->seps);
    }

    public function testInjectStyles()
    {
        global $actions;
        $Seps = new Separators(23, 24);
        $Seps->styleSeparators();

        $lastAction = array_pop($actions);

        $this->assertArrayHasKey('add', $lastAction);
        $this->assertEquals($lastAction['add'], 'admin_enqueue_scripts');
    }

    public function testAddSeparators()
    {
        global $menu;
        $Seps = new Separators(23, 24);
        $Seps->addSeparators();

        $this->assertCount(2, $menu);
        $this->assertContains('wp-menu-separator', end($menu));
    }

    public function testAddFloatSeparator()
    {
        global $menu;
        $floatArg = 23.1234;
        $Seps = new Separators($floatArg);
        $Seps->addSeparators();

        $this->assertArrayHasKey("$floatArg", $menu);
    }
}
