<?php

if (!function_exists('format_price')) {
    function format_price($price, $prefix = 'Rp. ', $decimal = 0, $decimal_separator = ',' , $thousands_separator = '.') {
        return ($prefix ?? '') . number_format($price, $decimal, $decimal_separator, $thousands_separator);
    }
}