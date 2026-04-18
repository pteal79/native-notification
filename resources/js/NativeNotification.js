/**
 * NativeNotification Plugin for NativePHP Mobile
 *
 * @example
 * import { NativeNotification, Events } from '@pteal79/native-notification';
 *
 * // Send a notification
 * await NativeNotification.sendNotification('Hello world');
 *
 * // Listen for the dispatched event
 * import { on } from '@nativephp/native';
 * on(Events.NativeNotification, (payload) => console.log(payload.message));
 */

const baseUrl = '/_native/api/call';

async function bridgeCall(method, params = {}) {
    const response = await fetch(baseUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
        },
        body: JSON.stringify({ method, params })
    });

    const result = await response.json();

    if (result.status === 'error') {
        throw new Error(result.message || 'Native call failed');
    }

    const nativeResponse = result.data;
    if (nativeResponse && nativeResponse.data !== undefined) {
        return nativeResponse.data;
    }

    return nativeResponse;
}

async function sendNotification(message = null) {
    return bridgeCall('NativeNotification.SendNotification', { message });
}

export const NativeNotification = {
    sendNotification,
};

export const Events = {
    MobileEvent: 'PTeal79\\NativeNotification\\Events\\MobileEvent',
};

export default NativeNotification;
