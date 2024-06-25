<?php

namespace Framework;

use Controllers\ErrorController;
use Framework\Middleware\Authorize;

class Router
{
    private $routes = [];

    /**
     * Register Route
     * @param string $method
     * @param string $uri
     * @param string $action
     * @return void
     */

    public function registerRoute($method, $uri, $action,)
    {
        //Destrucutring
        list($controller, $controllerMethod) = explode('@', $action);


        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
            'controllerMethod' => $controllerMethod,
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
     * Route  the request
     * @param string $uri
     * @param string $method
     * @return void
     */

    public function route($uri)
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        // Check for _method input
        if ($requestMethod === 'POST' && isset($_POST['_method'])) {
            // Override the request method with the value of _method
            $requestMethod = strtoupper($_POST['_method']);
        }

        

        foreach ($this->routes as $route) {
            // split the uri into parts
            $uriParts = explode('/', trim($uri, '/'));
            
            // split the route uri into parts
            $routeParts = explode('/', trim($route['uri'], '/'));
   
        
            $match = true;

            // check if the number of parts is the same

            if (count($uriParts) === count($routeParts) && strtoupper($route['method']) === $requestMethod) {
                $params = [];
                $match = true;
                for ($i = 0; $i < count($uriParts); $i++) {

                    // if the uris do not match and there is no param
                    if ($routeParts[$i] !== $uriParts[$i] && !preg_match('/\{(.+?)\}/', $routeParts[$i])) {
                        $match = false;
                        break;
                    }
                    // Check for the param and add to $params array
                    if (preg_match('/\{(.+?)\}/', $routeParts[$i], $matches)) {
                        $params[$matches[1]] = $uriParts[$i];
                        
                    }
                }
                if ($match) {
                    $controller = 'Controllers\\' . $route['controller'];
                    $controllerMethod = $route['controllerMethod'];
                    
                    $controllerInstance = new $controller(); 
                    $controllerInstance->$controllerMethod($params); 
                    return;
                }
            }
        }
        ErrorController::notFound();
    }
}
