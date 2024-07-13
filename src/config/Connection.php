<?php

class Connection
{
    public static function make()
    {
        try {
            return new PDO("mysql:host=localhost;dbname=php_test_nals", 'root', '');
        } catch (\Throwable $th) {
            Log::logException($th);
        }
    }
}