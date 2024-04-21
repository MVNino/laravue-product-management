<?php

namespace App\Enums;

class HttpCode {
    const OK = 200;
    const CREATED = 201;
    const NO_CONTENT = 204;

    const BAD_REQUEST = 400;
    const UNAUTHORIZED = 401;
    const NOT_FOUND = 404;

    const SERVER_ERROR = 500;
}