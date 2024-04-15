<?php

namespace App\Install;

class Requirement
{
    public function extensions()
    {
        $version = phpversion();
        return [
            'PHP = 7.2.x' => version_compare($version, '7.2', '>=') && version_compare($version, '7.4', '<'),
            'FileInfo PHP Extension' => extension_loaded('fileinfo'),
            'BCMath PHP Extension' => extension_loaded('bcmath'),
            'Curl PHP Extension' => extension_loaded('curl'),
            'OpenSSL PHP Extension' => extension_loaded('openssl'),
            'PDO PHP Extension' => extension_loaded('pdo'),
            'Mbstring PHP Extension' => extension_loaded('mbstring'),
            'Tokenizer PHP Extension' => extension_loaded('tokenizer'),
            'XML PHP Extension' => extension_loaded('xml'),
            'Ctype PHP Extension' => extension_loaded('ctype'),
            'JSON PHP Extension' => extension_loaded('json'),
            'Zip PHP Extension' => extension_loaded('zip'),
            'ionCube Loader Extension' => extension_loaded('ionCube Loader'),
        ];
    }

    public function directories()
    {
        return [
            '.env' => is_writable(base_path('.env')),
            'storage' => is_writable(storage_path()),
            'bootstrap/cache' => is_writable(app()->bootstrapPath('cache')),
        ];
    }

    /**
     * @return mixed
     */
    public function satisfied()
    {
        return collect($this->extensions())
            ->merge($this->directories())
            ->every(function ($item) {
                return $item;
            });
    }
}
