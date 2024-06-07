<?php
class Router
{
    protected $routes = [];

    /**
     * Register Route
     * @param string $method
     * @param string $uri
     * @param string $controller
     * @return void
     */

    public function registerRoute($method, $uri, $controller)
    {
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
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

     public function error($httpCode = 404)
     {
         http_response_code($httpCode);
         loadView("error/{$httpCode}");
         exit;
     }

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
                require basePath('App/' . $route['controller']);
                return;
            }
        }
        $this->error();
    }
}
