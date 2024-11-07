<?php
class Router {
    private $routes = [];

    public function __construct()
    {
        $this->routes = [
            'GET' => [],
            'POST' => [],
            'PUT' => [],
            'DELETE' => [],
        ];

        // Páginas principais
        $this->get('/', 'HomeController@index');
        $this->get('/login', 'UserController@loginForm');
        $this->get('/cadastro', 'UserController@registerForm');
        $this->get('/criar-conto', 'ContosController@createForm');
        $this->get('/meus-contos', 'ContosController@myContos');
        $this->get('/contos', 'ContosController@allContos');

        //APIs de CRUD para Usuários
        $this->post('/api/usuarios', 'UserController@login');
        $this->post('/api/usuarios/cadastro', 'UserController@register');

        // APIs de CRUD para os Contos
        $this->post('/api/contos', 'ContosController@create');
        $this->get('/api/contos', 'ContosController@index');
        $this->get('/api/contos/:id', 'ContosController@show');
        $this->put('/api/contos/:id', 'ContosController@update');
        $this->delete('/api/contos/:id', 'ContosController@destroy');

    }

    public function get($uri, $action){
        $this->addRoute('GET', $uri, $action);
    }

    public function post($uri, $action){
        $this->addRoute('POST', $uri, $action);
    }

    public function put($uri, $action){
        $this->addRoute('PUT', $uri, $action);
    }

    public function delete($uri, $action){
        $this->addRoute('DELETE', $uri, $action);
    }

    private function addRoute($method, $uri, $action){
        $this->routes[$method][$uri] = $action;
    }

    public function route(){
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        foreach($this->routes[$method] as $route => $action){
            $pattern = preg_replace('#:([\w]+)#', '([^/]+)', $route);
            if(preg_match('#^' . $pattern . '$#', $uri, $matches)){
                array_shift($matches);
                $this->dispatch($action, $matches);
                return;
            }
        }

        http_response_code(404);
        echo "404 Not Found";
    }

    private function dispatch($action, $params){
        list($controller, $method) = explode('@', $action);
        $controller = 'Src\\controllers\\' . $controller;
        call_user_func_array([new $controller, $method], $params);
    }

    public function listRoutes(){
        var_dump($this->routes);
    }

}