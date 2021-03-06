<?php

namespace Core;

class Router
{

    protected array $routes = [];
    protected array $params = [];

    function __construct()
    {
        // Add our built-in route for the resources.
        $this->add('resources/{random:\d+}/scss/', ['controller' => 'Scss', 'action' => 'compile']);
    }

    public function add($route, $params = [])
    {
        $route = preg_replace('/\//', '\\/', $route);
        $route = preg_replace('/{([a-z]+)}/', '(?P<\1>[a-z-]+)', $route);
        $route = preg_replace('/{([a-z]+):([^}]+)}/', '(?P<\1>\2)', $route);
        $route = '/^' . $route . '$/i';
        $this->routes[$route] = $params;

    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function match($url)
    {
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $params[$key] = $match;
                    }
                }

                $this->params = $params;
                return true;
            }
        }

        return false;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function dispatch($url)
    {
        $url = $this->removeQueryStringVariables($url);

        if ($this->match($url)) {
            $controller = $this->params['controller'];
            $controller = $this->convertToStudlyCaps($controller);
            $controller = @explode("/", $url)[0] != "resources" ?               // Add our resources controller
                $this->getNamespace() . $controller : "\\Core\\".$controller;   // Using our reserved route

            if(!class_exists($controller))
            {
                throw new \Exception("Controller class $controller not found");
            }

            $controller_object = new $controller($this->params);

            $action = $this->params['action'];
            $action = $this->convertToCamelCase($action);

            if (preg_match('/action$/i', $action) == 0)
            {
                $controller_object->$action();
            }
            else
            {
                throw new \Exception("Method $action in controller $controller cannot be called directly - remove the Action suffix to call this method");
            }
        }
        else
        {
            throw new \Exception('No route matched.', 404);
        }
    }

    protected function convertToStudlyCaps($string)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }

    protected function convertToCamelCase($string)
    {
        return lcfirst($this->convertToStudlyCaps($string));
    }

    /**
     *   URL                           $_SERVER['QUERY_STRING']  Route
     *   -------------------------------------------------------------------
     *   localhost                     ''                        ''
     *   localhost/?                   ''                        ''
     *   localhost/?page=1             page=1                    ''
     *   localhost/posts?page=1        posts&page=1              posts
     *   localhost/posts/index         posts/index               posts/index
     *   localhost/posts/index?page=1  posts/index&page=1        posts/index
     *
     * @param string $url The full URL
     *
     * @return string The URL with the query string variables removed
     */
    protected function removeQueryStringVariables($url)
    {
        if ($url != '') {
            $parts = explode('&', $url, 2);

            if (strpos($parts[0], '=') === false) {
                $url = $parts[0];
            } else {
                $url = '';
            }
        }

        return $url;
    }

    protected function getNamespace()
    {
        $namespace = 'App\Controllers\\';

        if (array_key_exists('namespace', $this->params)) {
            $namespace .= $this->params['namespace'] . '\\';
        }

        return $namespace;
    }
}
