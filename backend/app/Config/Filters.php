<?php

namespace Config;

use AppFiltersApiAuthFilter;
use AppFiltersAuth;
use CodeIgniterConfigBaseConfig;

class Filters extends BaseConfig
{
    public array $aliases = [
        'auth' => Auth::class,
        'apiAuth' => ApiAuthFilter::class,
    ];
}
