<?php

namespace App\Install;

class ServerPhpExtension
{
    public function extensions()
    {
        return [
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
            'IonCube Loader' => extension_loaded('ioncube loader'),
            'OPCache PHP Extension' => extension_loaded('opcache'),
        ];
    }

    /**
     * @return mixed
     */
    public function satisfied()
    {
        return collect($this->extensions())
            ->every(function ($item) {
                return $item;
            });
    }
}
