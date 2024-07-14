<?php

class Connection
{
    /**
     * Connection database
     *
     * @param array $config
     *
     */
    public static function make(array $config)
    {
        try {
            $db       = $config['connections']['mysql']['driver'];
            $host     = $config['connections']['mysql']['host'];
            $database = $config['connections']['mysql']['database'];
            $username = $config['connections']['mysql']['username'];
            $password = $config['connections']['mysql']['password'];

            return new PDO("$db:host=$host;dbname=$database", $username, $password);
        } catch (\Throwable $th) {
            Log::logException($th);
        }
    }
}