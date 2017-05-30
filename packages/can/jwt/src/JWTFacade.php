<?php
namespace Can\Jwt;

use Illuminate\Support\Facades\Facade;

class JWTFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'jwtAuth';
    }
}
