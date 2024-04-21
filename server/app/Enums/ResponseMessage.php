<?php

namespace App\Enums;

class ResponseMessage {
    const FIND_ALL = 'find all';
    const FIND_ONE = 'find one';
    const CREATED = 'created';
    const UPDATED = 'updated';
    const DELETED = 'deleted';

    // User
    const LOGIN_SUCCESS = 'login success';
    const USER_REGISTERED = 'user registered';
    const USER_404 = 'user not found';
    const LOGOUT_SUCCESS = 'logout success';
    const LOGOUT_FAILED = 'logout failed';
}