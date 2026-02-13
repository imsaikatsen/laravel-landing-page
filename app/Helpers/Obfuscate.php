<?php

function hexEncode($string)
{
    $result = '';
    foreach (mb_str_split($string) as $char) {
        $result .= '&#x' . dechex(mb_ord($char)) . ';';
    }
    return $result;
}
