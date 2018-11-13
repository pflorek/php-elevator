<?php

namespace PFlorek\Elevator;

class Elevator
{
    /**
     * Elevates a map to a tree. The hash map keys are splitted by the delimiter into tokens. The token will become
     * the key of each node in the resulting tree.
     *
     * @param mixed[] $flattened The map to be elevated to a tree.
     * @param string  $delimiter The delimiter to split the map's keys.
     *
     * @return mixed[]
     */
    public static function up(array &$flattened, $delimiter = '.')
    {
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
     * Folds a tree down to a map. The node's keys are joined with the delimiter to a materialized path.
     *
     * @param array  $elevated  The tree to be fold down to a map.
     * @param string $delimiter The delimiter used to materialize the path.
     *
     * @return array
     */
    public static function down(array &$elevated, $delimiter = '.')
    {
        $result = [];

        static::walk($result, $elevated, $delimiter);

        return $result;
    }

    /**
     * Internal pre-order tree walker appends each leaf with its materialized path to the resulting map.
     *
     * @param array  $result
     * @param array  $elevated
     * @param string $delimiter
     * @param string $path
     */
    private static function walk(array &$result, array &$elevated, $delimiter, $path = null)
    {
        foreach ($elevated as $key => $value) {
            $current = null !== $path ? $path . $delimiter . $key : $key;

            if (!is_array($value) || !count($value)) {
                $result[$current] = $value;
            } else {
                static::walk($result, $value, $delimiter, $current);
            }
        }
    }
}
