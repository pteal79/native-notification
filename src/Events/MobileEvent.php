<?php

namespace PTeal79\NativeNotification\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MobileEvent
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public ?string $message = null
    ) {}
}
