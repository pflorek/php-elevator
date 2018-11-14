<?php

namespace PFlorek\Elevator;

/**
 * Elevates an one-dimensional or any \Traversable to a multi-dimensional array.
 *
 * @param array|\Traversable $flattened
 * @param string $delimiter
 * @return array
 */
function array_elevate($flattened, $delimiter = '.')
{
    return Elevator::up($flattened, $delimiter);
}

/**
 * Flattens a multi-dimensional array or any \\Traversable into an one-dimensional array.
 *
 * @param array|\Traversable $elevated
 * @param string $delimiter
 * @return array
 */
function array_flatten($elevated, $delimiter = '.')
{
    return Elevator::down($elevated, $delimiter);
}
