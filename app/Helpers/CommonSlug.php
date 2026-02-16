<?php

function generate_slug($string)
{
    // return Str::slug($string, '-', 'zh');
    // $slug = preg_replace('/[^\p{L}\p{N}]+/u', '-', $string);
    $slug = preg_replace('/[^\p{L}\p{N}\p{M}]+/u', '-', $string);
    $slug = trim($slug, '-');
    return $slug;
}
