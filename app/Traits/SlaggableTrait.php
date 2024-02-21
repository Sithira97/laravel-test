<?php

namespace App\Traits;

trait SlaggableTrait
{
    public function generateSlug($string)
    {
        return \Str::slug($string);
    }
}