<?php

class Router
{
    protected $routers = [
        'GET'       => [],
        'POST'      => [],
        'PUT'       => [],
        'DELETE'    => [],
    ];

    /**
     * Handle redirect router
     *
     * @param string $url
     * @param string $method
     *
     */
    public function direct(string $url, string $method)
    {
        try {
            if (isset($this->routers[$method][$url])) {
                $controller = explode('@', $this->routers[$method][$url])[0];
                $action     = explode('@', $this->routers[$method][$url])[1];

                include("src/controllers/$controller.php");

                $rs = new $controller;
                $rs->$action();
            } else {
                Log::error('Path url notfound');
                include("src/views/layout/error.php");
            }
        } catch (\Throwable $th) {
            Log::logException($th);
        }
    }

    /**
     * Get data
     *
     * @param string|null $path
     * @param mixed $controllerAction
     *
     */
    public function get(string|null $path, string $controllerAction)
    {
        $this->routers['GET'][$path] = $controllerAction;
    }

    /**
     * Post data
     *
     * @param string $path
     * @param string $controllerAction
     *
     */
    public function post(string $path, string $controllerAction)
    {
        $this->routers['POST'][$path] = $controllerAction;
    }

    /**
     * Delete data
     *
     * @param string $path
     * @param string $controllerAction
     *
     */
    public function delete(string $path, string $controllerAction)
    {
        $this->routers['DELETE'][$path] = $controllerAction;
    }

    /**
     * Put data
     *
     * @param string $path
     * @param string $controllerAction
     *
     */
    public function put(string $path, string $controllerAction)
    {
        $this->routers['PUT'][$path] = $controllerAction;
    }
}