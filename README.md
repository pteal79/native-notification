# NativeNotification Plugin for NativePHP Mobile

Dispatches a `NativeNotification` event through the native layer via a single `SendNotification` bridge call. The event carries a nullable string payload and can be consumed in PHP with `#[OnNative]`.

## Installation

```bash
composer require pteal79/native-notification
php artisan vendor:publish --tag=nativephp-plugins-provider
php artisan native:plugin:register pteal79/native-notification
php artisan native:plugin:list
```

## Usage

### PHP (Livewire/Blade)

```php
use PTeal79\NativeNotification\Facades\NativeNotification;

NativeNotification::sendNotification('Hello world!');
NativeNotification::sendNotification(null);
```

### Listening for the Event

```php
use Native\Mobile\Attributes\OnNative;
use PTeal79\NativeNotification\Events\MobileEvent;

#[OnNative(MobileEvent::class)]
public function handleNativeNotification(?string $message): void
{
    // $message is the string passed to sendNotification()
}
```

### JavaScript

```javascript
import { NativeNotification, Events } from '@pteal79/native-notification';
import { on, off } from '@nativephp/native';

await NativeNotification.sendNotification('Hello!');

const handler = (payload) => console.log(payload.message);
on(Events.MobileEvent, handler);
off(Events.MobileEvent, handler);
```

## Events

| Event | Payload | Description |
|-------|---------|-------------|
| `MobileEvent` | `{ message: string\|null }` | Dispatched by the native layer when `sendNotification` is called |

## License

MIT
