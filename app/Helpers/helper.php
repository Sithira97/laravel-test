<?php


function slugCustom(string $string)
{
    $slug = \Str::slug($string);
    return $slug;
}