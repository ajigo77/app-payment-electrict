<?php

namespace App\Helpers;

use Hashids\Hashids;

class HashIdHelper
{
    private static function getHashids()
    {
        return new Hashids(env('APP_KEY', 'your-salt-string'), 5);
    }

    public static function encode($id)
    {
        return self::getHashids()->encode($id);
    }

    public static function decode($hash)
    {
        $decoded = self::getHashids()->decode($hash);
        return !empty($decoded) ? $decoded[0] : null;
    }
}
