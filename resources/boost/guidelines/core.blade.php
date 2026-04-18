## pteal79/native-notification

A NativePHP plugin that dispatches a `NativeNotification` event through the native layer via a single `SendNotification` bridge function.

### Installation

```bash
composer require pteal79/native-notification
php artisan vendor:publish --tag=nativephp-plugins-provider
php artisan native:plugin:register pteal79/native-notification
php artisan native:plugin:list
```

### PHP Usage (Livewire/Blade)

@verbatim
<code-snippet name="Sending a Notification" lang="php">
use PTeal79\NativeNotification\Facades\NativeNotification;

NativeNotification::sendNotification('Hello from PHP!');
NativeNotification::sendNotification(null); // nullable string is accepted
</code-snippet>
@endverbatim

### Listening for the NativeNotification Event

@verbatim
<code-snippet name="OnNative Event Listener" lang="php">
use Native\Mobile\Attributes\OnNative;
use PTeal79\NativeNotification\Events\MobileEvent;

#[OnNative(MobileEvent::class)]
public function handleNativeNotification(?string $message)
{
    // $message contains the string passed to SendNotification
}
</code-snippet>
@endverbatim

### JavaScript Usage

@verbatim
<code-snippet name="JS sendNotification" lang="javascript">
import { NativeNotification, Events } from '@pteal79/native-notification';
import { on, off } from '@nativephp/native';

await NativeNotification.sendNotification('Hello!');

const handler = (payload) => console.log(payload.message);
on(Events.MobileEvent, handler);
off(Events.MobileEvent, handler);
</code-snippet>
@endverbatim
