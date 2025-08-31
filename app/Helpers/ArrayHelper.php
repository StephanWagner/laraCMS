<?php

namespace App\Helpers;

class ArrayHelper
{
    /**
     * Recursively merge arrays (deep merge).
     *
     * - Keeps existing values unless overwritten
     * - Merges nested arrays
     * - Overwrites scalar values
     *
     * @param array $array1 Existing array
     * @param array $array2 Incoming array (overwrites/extends)
     * @return array
     */
    public static function mergeRecursiveDistinct(?array $array1, ?array $array2): array
    {
        $array1 = $array1 ?? [];
        $array2 = $array2 ?? [];

        $merged = $array1;

        foreach ($array2 as $key => $value) {
            if (is_array($value) && isset($merged[$key]) && is_array($merged[$key])) {
                $merged[$key] = self::mergeRecursiveDistinct($merged[$key], $value);
            } else {
                $merged[$key] = $value;
            }
        }

        return $merged;
    }
}
