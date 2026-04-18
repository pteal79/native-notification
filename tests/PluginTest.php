<?php

beforeEach(function () {
    $this->pluginPath = dirname(__DIR__);
    $this->manifestPath = $this->pluginPath . '/nativephp.json';
});

describe('Plugin Manifest', function () {
    it('has a valid nativephp.json file', function () {
        expect(file_exists($this->manifestPath))->toBeTrue();

        $manifest = json_decode(file_get_contents($this->manifestPath), true);

        expect(json_last_error())->toBe(JSON_ERROR_NONE);
    });

    it('has required fields', function () {
        $manifest = json_decode(file_get_contents($this->manifestPath), true);

        expect($manifest)->toHaveKeys(['namespace', 'bridge_functions']);
    });

    it('has a SendNotification bridge function', function () {
        $manifest = json_decode(file_get_contents($this->manifestPath), true);

        $names = array_column($manifest['bridge_functions'], 'name');
        expect($names)->toContain('NativeNotification.SendNotification');
    });

    it('registers the NativeNotification event', function () {
        $manifest = json_decode(file_get_contents($this->manifestPath), true);

        expect($manifest['events'])->toContain('PTeal79\\NativeNotification\\Events\\MobileEvent');
    });
});

describe('Native Code', function () {
    it('has Android Kotlin file', function () {
        expect(file_exists($this->pluginPath . '/resources/android/NativeNotificationFunctions.kt'))->toBeTrue();
    });

    it('has iOS Swift file', function () {
        expect(file_exists($this->pluginPath . '/resources/ios/NativeNotificationFunctions.swift'))->toBeTrue();
    });
});

describe('PHP Classes', function () {
    it('has service provider', function () {
        expect(file_exists($this->pluginPath . '/src/NativeNotificationServiceProvider.php'))->toBeTrue();
    });

    it('has facade', function () {
        expect(file_exists($this->pluginPath . '/src/Facades/NativeNotification.php'))->toBeTrue();
    });

    it('has main class', function () {
        expect(file_exists($this->pluginPath . '/src/NativeNotification.php'))->toBeTrue();
    });

    it('has MobileEvent event class', function () {
        expect(file_exists($this->pluginPath . '/src/Events/MobileEvent.php'))->toBeTrue();
    });
});

describe('Composer Configuration', function () {
    it('has valid composer.json', function () {
        $composerPath = $this->pluginPath . '/composer.json';
        expect(file_exists($composerPath))->toBeTrue();

        $composer = json_decode(file_get_contents($composerPath), true);

        expect(json_last_error())->toBe(JSON_ERROR_NONE);
        expect($composer['type'])->toBe('nativephp-plugin');
    });
});
