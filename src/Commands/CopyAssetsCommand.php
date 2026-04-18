<?php

namespace PTeal79\NativeNotification\Commands;

use Native\Mobile\Plugins\Commands\NativePluginHookCommand;

class CopyAssetsCommand extends NativePluginHookCommand
{
    protected $signature = 'nativephp:native-notification:copy-assets';

    protected $description = 'Copy assets for NativeNotification plugin';

    public function handle(): int
    {
        if ($this->isAndroid()) {
            $this->info('Android assets copied for NativeNotification');
        }

        if ($this->isIos()) {
            $this->info('iOS assets copied for NativeNotification');
        }

        return self::SUCCESS;
    }
}
