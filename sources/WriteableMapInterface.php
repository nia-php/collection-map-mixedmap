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

use OutOfBoundsException;

/**
 * Interface for all writeable map implementations.
 */
interface WriteableMapInterface extends MapInterface
{

    /**
     * Sets a value with a unique name. If the value is already set in this map it will be overwritten.
     *
     * @param string $name
     *            Name of the value.
     * @param mixed $value
     *            The value.
     * @return WriteableMapInterface Reference to this instance.
     */
    public function set(string $name, $value): WriteableMapInterface;

    /**
     * Removes a value from this map by it's name.
     *
     * @param string $name
     *            Name of the value.
     * @throws OutOfBoundsException If the requested value does not exist.
     * @return WriteableMapInterface Reference to this instance.
     */
    public function remove(string $name): WriteableMapInterface;
}
