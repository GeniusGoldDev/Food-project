<?php

namespace App\Install;

use DotenvEditor;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class Database
{
    /**
     * @param $data
     */
    public function setup($data)
    {
        $this->checkDatabaseConnection($data);
        $this->setEnvVariables($data);
        $this->migrateDatabase();
        $this->addOrderStatuses();
    }

    /**
     * @param $data
     */
    private function checkDatabaseConnection($data)
    {
        $this->setupDatabaseConnectionConfig($data);

        DB::connection('mysql')->reconnect();
        DB::connection('mysql')->getPdo();
    }

    /**
     * @param $data
     */
    private function setupDatabaseConnectionConfig($data)
    {
        config([
            'database.default' => 'mysql',
            'database.connections.mysql.host' => $data['host'],
            'database.connections.mysql.port' => $data['port'],
            'database.connections.mysql.database' => $data['database'],
            'database.connections.mysql.username' => $data['username'],
            'database.connections.mysql.password' => $data['password'],
        ]);
    }

    /**
     * @param $data
     */
    private function setEnvVariables($data)
    {
        $env = DotenvEditor::load();
        $env->setKey('DB_HOST', $data['host']);
        $env->setKey('DB_PORT', $data['port']);
        $env->setKey('DB_DATABASE', $data['database']);
        $env->setKey('DB_USERNAME', $data['username']);
        $env->setKey('DB_PASSWORD', $data['password']);

        $env->save();
    }

    private function migrateDatabase()
    {
        Artisan::call('migrate', ['--force' => true]);
    }

    private function addOrderStatuses()
    {
        DB::table('orderstatuses')->truncate();
        DB::statement("INSERT INTO `orderstatuses` (`id`, `name`) VALUES (1, 'Order Placed'), (2, 'Preparing Order'), (3, 'Delivery Guy Assigned'), (4, 'Order Picked Up'), (5, 'Delivered'), (6, 'Canceled'), (7, 'Ready For Pick Up'), (8, 'Awaiting Payment'), (9, 'Payment Failed')");
    }

}
