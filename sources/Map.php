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

use ArrayIterator;
use Iterator;
use OutOfBoundsException;

/**
 * Default mixed map implementation.
 */
class Map implements WriteableMapInterface
{

    /**
     * Native PHP mixed map.
     *
     * @var mixed[]
     */
    private $values = [];

    /**
     * Constructor.
     *
     * @param mixed[] $values
     *            Native PHP mixed map to assign.
     */
    public function __construct(array $values = [])
    {
        foreach ($values as $name => $value) {
            $this->set($name, $value);
        }
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Nia\Collection\Map\MixedMap\MapInterface::has($name)
     */
    public function has(string $name): bool
    {
        return array_key_exists($name, $this->values);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Nia\Collection\Map\MixedMap\MapInterface::get($name)
     */
    public function get(string $name)
    {
        if (! $this->has($name)) {
            throw new OutOfBoundsException(sprintf('Value "%s" is not set.', $name));
        }

        return $this->values[$name];
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Nia\Collection\Map\MixedMap\MapInterface::tryGet($name, $default)
     */
    public function tryGet(string $name, $default)
    {
        if ($this->has($name)) {
            return $this->values[$name];
        }

        return $default;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Nia\Collection\Map\MixedMap\WriteableMapInterface::set($name, $value)
     */
    public function set(string $name, $value): WriteableMapInterface
    {
        $this->values[$name] = $value;

        return $this;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Nia\Collection\Map\MixedMap\WriteableMapInterface::remove($name)
     */
    public function remove(string $name): WriteableMapInterface
    {
        if (! $this->has($name)) {
            throw new OutOfBoundsException(sprintf('Value "%s" is not set.', $name));
        }

        unset($this->values[$name]);

        return $this;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \IteratorAggregate::getIterator()
     */
    public function getIterator(): Iterator
    {
        return new ArrayIterator($this->values);
    }
}
