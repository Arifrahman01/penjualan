<?php


if(!function_exists('selected')) {
    function selected($a, $b)
    {
        return $a == $b ? 'selected' : '' ;
    }
}

if(!function_exists('checked')) {
    function checked($a, $b)
    {
        return $a == $b ? 'checked' : '' ;
    }
}
