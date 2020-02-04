<?php

namespace Core;

use Core\Response;

abstract class Controller
{
    protected Responses $response;
    protected array $route_params = [];

    public function __construct($route_params)
    {
        $this->response     = new Responses();
        $this->route_params = $route_params;
    }

    // Used so we can call the before and after method.
    public function __call($name, $args)
    {
        $method = $name . 'Action';

        if (method_exists($this, $method)) {
            if ($this->before() !== false) {
                call_user_func_array([$this, $method], $args);
                $this->after();
            }
        } else {
            throw new \Exception("Method $method not found in controller " . get_class($this));
        }
    }

    protected function before()
    {
    }

    protected function after()
    {
    }
}
