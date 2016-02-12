<?php
/*
 * This file is part of the nia framework architecture.
 *
 * (c) Patrick Ullmann <patrick.ullmann@nat-software.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types = 1);
namespace Test\Nia\Collection\Map\MixedMap;

use PHPUnit_Framework_TestCase;
use Nia\Collection\Map\MixedMap\Map;
use Nia\Collection\Map\MixedMap\ReadOnlyMap;

/**
 * Unit test for \Nia\Collection\Map\MixedMap\ReadOnlyMap.
 */
class ReadOnlyMapTest extends PHPUnit_Framework_TestCase
{

    private $map = null;

    protected function setUp()
    {
        $this->map = new ReadOnlyMap(new Map([
            'foo' => 123,
            'bar' => '456'
        ]));
    }

    protected function tearDown()
    {
        $this->map = null;
    }

    /**
     * @covers \Nia\Collection\Map\MixedMap\ReadOnlyMap::has
     */
    public function testHas()
    {
        $this->assertSame(true, $this->map->has('foo'));
        $this->assertSame(true, $this->map->has('bar'));
        $this->assertSame(false, $this->map->has('baz'));
    }

    /**
     * @covers \Nia\Collection\Map\MixedMap\ReadOnlyMap::get
     */
    public function testGet()
    {
        $this->assertSame(123, $this->map->get('foo'));
        $this->assertSame('456', $this->map->get('bar'));
    }

    /**
     * @covers \Nia\Collection\Map\MixedMap\ReadOnlyMap::get
     */
    public function testGetException()
    {
        $this->setExpectedException(\OutOfBoundsException::class, 'Value "baz" is not set.');

        $this->map->get('baz');
    }

    /**
     * @covers \Nia\Collection\Map\MixedMap\ReadOnlyMap::tryGet
     */
    public function testTryGet()
    {
        $this->assertSame(123, $this->map->tryGet('foo', 'bla'));
        $this->assertSame('456', $this->map->tryGet('bar', 'bla'));
        $this->assertSame('bla', $this->map->tryGet('baz', 'bla'));

        $class = new \stdClass();

        $this->assertSame($class, $this->map->tryGet('baz', $class));
    }

    /**
     * @covers \Nia\Collection\Map\MixedMap\ReadOnlyMap::getIterator
     */
    public function testGetIterator()
    {
        $values = [
            'foo' => 123,
            'bar' => '456'
        ];

        $this->assertInstanceOf(\Iterator::class, $this->map->getIterator());
        $this->assertSame($values, iterator_to_array($this->map->getIterator()));
    }
}
