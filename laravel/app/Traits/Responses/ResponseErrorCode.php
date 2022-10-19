<?php

namespace App\Traits\Responses;

class ResponseErrorCode
{
    const SERVER_ERROR     = 'internal_server_error';
    const NOT_FOUND        = 'not_found';
    const VALIDATION_ERROR = 'validation_error';
    const UNAUTHORIZED     = 'unauthorized';
    const FORBIDDEN        = 'forbidden';
}
