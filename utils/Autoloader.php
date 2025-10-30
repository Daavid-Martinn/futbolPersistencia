<?php
// utils/Autoloader.php
namespace Utils;

class Autoloader {
    public static function register() {
        spl_autoload_register(function ($class) {
            // Directorio base del proyecto
            $base_dir = __DIR__ . '/../';

            // Mapeo de prefijos de namespace a directorios base
            // 'App\' se mapea al directorio 'app/'
            // 'App\Persistence\' se mapea al directorio 'persistence/'
            $prefixes = [
                'App\\Persistence\\' => $base_dir . 'persistence/',
                'App\\' => $base_dir . 'app/',
            ];

            // Reemplaza el prefijo del namespace con el directorio base correspondiente
            $file = str_replace(array_keys($prefixes), array_values($prefixes), $class);
            $file = str_replace('\\', DIRECTORY_SEPARATOR, $file) . '.php';

            if (file_exists($file)) {
                require_once $file;
            }
        });
    }
}