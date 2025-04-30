<?php

namespace App\Constants;

use App\Constants\Interfaces\HasAllConsts;
class Roles implements HasAllConsts{
    const USER = 'user';
    const ADMIN = 'admin';
    const MANAGER = 'manager';

    public static function getAll(): array {
        return [
            self::USER,
            self::ADMIN,
            self::MANAGER
        ];
    }
}
