<?php

namespace App\Constants\Auth;

use App\Constants\Interfaces\HasAllConsts;

class Permissions implements HasAllConsts {
    const READ = 'read';
    const CREATE = 'create';
    const UPDATE = 'update';
    const DELETE = 'delete';

    public static function getAll(): array {
        return [
            self::READ,
            self::CREATE,
            self::UPDATE,
            self::DELETE
        ];
    }
}
