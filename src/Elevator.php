<?php

namespace PFlorek\Elevator;

class Elevator
{
    /**
     * Elevates an one-dimensional or any \Traversable to a multi-dimensional array.
     * Splits the keys by the delimiter into tokens. The tokens will become
     * the key of each node of the multi-dimensional array.
     *
     * @param array|\Traversable $flattened The map to be elevated to a tree.
     * @param string $delimiter The delimiter to split the map's keys.
     * @return array
     */
    public function up($flattened, $delimiter = '.')
    {
        if (!is_iterable($flattened)) {
            throw new \RuntimeException('Argument must be of type iterable (array or \Traversable).');
        }

        $result = [];

        foreach ($flattened as $path => $value) {
            $current = &$result;

            foreach (explode($delimiter, $path) as $key) {
                $current[$key] = !array_key_exists($key, $current) ? [] : (array)$current[$key];

                $current = &$current[$key];
            }

            $current = $value;
        }

        return $result;
    }

    /**
     * Flattens a multi-dimensional array or any \\Traversable into an one-dimensional array.
     *
     * @param array|\Traversable $elevated The tree to be fold down to a map.
     * @param string $delimiter The delimiter used to materialize the path.
     * @return array
     */
    public function down($elevated, $delimiter = '.')
    {
        if (!is_iterable($elevated)) {
            throw new \RuntimeException('Argument must be of type iterable (array or \Traversable).');
        }

        $result = [];

        $this->walk($result, $elevated, $delimiter);

        return $result;
    }

    /**
     * Internal pre-order tree walker appends each leaf with its materialized path to the resulting map.
     *
     * @param array $result
     * @param array $elevated
     * @param string $delimiter
     * @param string $path
     */
    private function walk(&$result, &$elevated, $delimiter, $path = null)
    {
        foreach ($elevated as $key => $value) {
            $current = null !== $path ? $path . $delimiter . $key : $key;

            if (!is_array($value) || !count($value)) {
                $result[$current] = $value;
            } else {
                $this->walk($result, $value, $delimiter, $current);
            }
        }
    }
}
