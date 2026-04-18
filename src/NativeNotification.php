<?php

namespace PTeal79\NativeNotification;

class NativeNotification
{
    public function sendNotification(?string $message): void
    {
        if (function_exists('nativephp_call')) {
            nativephp_call('NativeNotification.SendNotification', json_encode(['message' => $message]));
        }
    }
}
