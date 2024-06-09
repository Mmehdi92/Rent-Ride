<?php

namespace Framework;

use Controllers\ErrorController;

class Router
{
    protected $routes = [];

    /**
     * Register Route
     * @param string $method
     * @param string $uri
     * @param string $action
     * @return void
     */

    public function registerRoute($method, $uri, $action)
    {
        //Destrucutring
        list($controller, $controllerMethod) = explode('@', $action);
      
         $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
            'controllerMethod' => $controllerMethod

        ];
    }

    /**
     * Get Route
     *@param string $uri 
     *@param string $controller
     *@return void
     */

    public function get($uri, $controller)
    {
        $this->registerRoute('GET', $uri, $controller);
    }


    /**
     *Post Route
     *@param string $uri 
     *@param string $controller
     *@return void
     */

    public function post($uri, $controller)
    {
        $this->registerRoute('POST', $uri, $controller);
    }



    /**
     *Put Route
     *@param string $uri 
     *@param string $controller
     *@return void
     */

    public function put($uri, $controller)
    {
        $this->registerRoute('PUT', $uri, $controller);
    }



    /**
     *Delete Route
     *@param string $uri 
     *@param string $controller
     *@return void
     */

    public function delete($uri, $controller)
    {
        $this->registerRoute('DELETE', $uri, $controller);
    }


    /**
     * @param $int $htppCode
     * @return void
     */

 

    /**
     * Route  the request
     * @param string $uri
     * @param string $method
     * @return void
     */

    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] ===  $uri && $route['method'] === $method) {
                
                // Extract controller and controller method 
                $controller = 'Controllers\\' . $route['controller'];
                $controllerMethod = $route['controllerMethod'];

                // Instastaite Controller and call method

                $controllerInstance = new $controller();
                $controllerInstance->$controllerMethod();
                return;
            }
        }
        ErrorController::notFound();
    }
}
