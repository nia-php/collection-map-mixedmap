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
namespace Nia\Collection\Map\MixedMap;

use Iterator;

/**
 * Decorator to encapsulate a map as read-only.
 */
class ReadOnlyMap implements MapInterface
{

    /**
     * Decorated map.
     *
     * @var MapInterface
     */
    private $map = null;

    /**
     * Constructor.
     *
     * @param MapInterface $map
     *            Map to decorate as a read-only map.
     */
    public function __construct(MapInterface $map)
    {
        $this->map = $map;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Nia\Collection\Map\MixedMap\MapInterface::has($name)
     */
    public function has(string $name): bool
    {
        return $this->map->has($name);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Nia\Collection\Map\MixedMap\MapInterface::get($name)
     */
    public function get(string $name)
    {
        return $this->map->get($name);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Nia\Collection\Map\MixedMap\MapInterface::tryGet($name, $default)
     */
    public function tryGet(string $name, $default)
    {
        return $this->map->tryGet($name, $default);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \IteratorAggregate::getIterator()
     */
    public function getIterator(): Iterator
    {
        return $this->map->getIterator();
    }
}
