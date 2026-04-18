<?php

namespace PTeal79\NativeNotification\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static void sendNotification(?string $message)
 *
 * @see \PTeal79\NativeNotification\NativeNotification
 */
class NativeNotification extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \PTeal79\NativeNotification\NativeNotification::class;
    }
}
