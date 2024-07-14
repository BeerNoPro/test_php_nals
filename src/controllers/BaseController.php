<?php

require_once 'src/public/bootstrap.php';

class BaseController
{
    // public function view($file, $data = [])
    // {
    //     if (is_file($file)) {
    //         extract($data);
    //         include $file;
    //     } else {
    //         include("src/views/layout/error.php");
    //     }
    // }

    /**
     * Get config
     *
     */
    public function config()
    {
        return require 'src/config/Constant.php';
    }

    /**
     * Connect database
     *
     */
    public function pdo()
    {
        return Connection::make($this->config());
    }

    /**
     * Redirect path url
     *
     * @param string|null $path
     *
     */
    public function redirect(string|null $path)
    {
        header("Location: $path");
    }
}