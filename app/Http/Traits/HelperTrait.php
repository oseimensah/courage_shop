<?php

namespace App\Http\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

/**
 * Trait to Validate and Store All Model Values
 * Validate relationships
 */
trait HelperTrait
{

    protected function unique_code()
    {
        $milliseconds = (string) round(microtime(true) * 568);
        $shuffled = str_shuffle($milliseconds);
        $id = substr($shuffled, 0, 12);
        return $id;
    }
}
