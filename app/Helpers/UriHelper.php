<?php

function generateUriFromPattern(string $pattern, array $values): string
{
    return preg_replace_callback('/\{(\w+)\}/', function ($matches) use ($values) {
        $key = $matches[1];
        return $values[$key] ?? '';
    }, $pattern);
}
