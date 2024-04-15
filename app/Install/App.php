<?php

namespace App\Install;

use App\Role;
use DotenvEditor;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class App
{
    public function setup()
    {
        $this->generateAppKey();
        $this->setEnvVariables();
        // Uncomment the below line for prod installation
        // $this->copyHtaccessFile();
    }
    private function generateAppKey()
    {
        Artisan::call('key:generate', ['--force' => true]);
    }

    private function setEnvVariables()
    {
        $env = DotenvEditor::load();

        $env->setKey('APP_ENV', 'local');
        $env->setKey('APP_DEBUG', 'true');
        $env->setKey('APP_URL', url('/'));

        $env->save();
    }

    private function copyHtaccessFile()
    {
        File::copy(base_path('.htaccess.example'), base_path('.htaccess'));
    }
}
