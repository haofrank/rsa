<?php

namespace HaoFrank\Rsa\Facades;

use Illuminate\Support\Facades\Facade;

class Rsa extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'rsa';
    }
}
