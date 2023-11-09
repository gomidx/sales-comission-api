<?php

namespace App\Enums;

enum HttpCode: int
{
    case CREATED = 201;
    case SUCCESS = 200;
    case NOT_FOUND = 404;
    case INTERNAL_SERVER_ERROR = 500;
    case FORBIDDEN = 403;
    case UNPROCESSABLE_ENTITY = 422;
    case UNAUTHORIZED = 401;
    case BAD_REQUEST = 400;
}