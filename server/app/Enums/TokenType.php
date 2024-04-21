<?php

namespace App\Enums;

class TokenType {
    const BEARER = 'bearer';
    const JWT = 'jwt';
    const SESSION = 'session';
    const BASIC_AUTH = 'basic authentication';
    const OAUTH = 'oauth 2.0';
}