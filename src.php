<?php

// Bytes returns the value described by $shorthand as number of bytes,
// following the rules in [1]. For instance bytes('1K') == 1024. The behaviour for $shorthand values that do not
// start with a number is undefined.
// 
// [1]: http://www.php.net/manual/en/faq.using.php#faq.using.shorthandbytes
function bytes($shorthand)
{
    // See zend_atol in Zend/zend_operators.c
    $n = intval($shorthand, 0);

    $l = strlen($shorthand);
    if ($l === 0) {
        return $n;
    }

    switch ($shorthand[$l-1]) {
        case 'g':
        case 'G':
            return $n << 30;
        case 'm':
        case 'M':
            return $n << 20;
        case 'k':
        case 'K':
            return $n << 10;
        default:
            return $n;
    }
}

// memory_limit_bytes returns bytes(ini_get('memory_limit')), or INF if the
// value is negative. The effective memory limit may be larger than this value,
// if the configured limit is small (less than 2MB or so).
function memory_limit_bytes()
{
    $x = bytes(ini_get('memory_limit'));

    return $x < 0 ? INF : $x;
}
