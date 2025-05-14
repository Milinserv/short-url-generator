<?php
namespace App\Services;

class ConfigService extends Service
{
    private static $settings = null; // Инициализируем null

    private static function load(): void
    {
        if (self::$settings === null) { // Загружаем только один раз
            self::$settings = include __DIR__ . '/../../config.php';
        }
    }

    public static function get($key): mixed
    {
        self::load();
        return self::$settings[$key] ?? null;
    }
}
