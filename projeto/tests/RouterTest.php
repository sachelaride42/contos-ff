<?php
use PHPUnit\Framework\TestCase;
use App\Router;
class RouterTest extends TestCase
{
    public function testRoute404()
    {
        ob_start();
        $_SERVER['REQUEST_METHOD'] = "GET";
        $_SERVER['REQUEST_URI'] = "/continhos";
        $router = new Router();
        $router->route();
        $output = ob_get_clean();
        $this->assertEquals("404 Not Found", $output);
    }
    // teste de APIs
    /*
     * $this->post('/api/usuarios', 'UserController@login');
        $this->post('/api/usuarios/cadastro', 'UserController@register');
        $this->get('/isLogged', 'UserController@isLogged');
        $this->get('/api/usuarios/:id', 'UserController@show');
    */
    public function testUserControllerLogin()
    {
        $_SERVER['REQUEST_METHOD'] = "POST";
        $_SERVER['REQUEST_URI'] = "/api/usuarios";
        $_SERVER['HTTP_CONTENT_TYPE'] = 'application/json';

        $data = json_encode([
            'email' => 'sss',
            'senha' => '1234567'
        ]);

        $this->simulateInput($data);

        ob_start();
        $router = new Router();
        $router->route();
        $output = ob_get_clean();

        $this->assertStringContainsString("sucesso", $output);
    }

    public function testUserControllerRegister(){
        $_SERVER['REQUEST_METHOD'] = "POST";
        $_SERVER['REQUEST_URI'] = "/api/usuarios/cadastro";
        $_SERVER['HTTP_CONTENT_TYPE'] = 'application/json';

        $data = json_encode([
            'nome' => 'Luiza',
            'email' => 'luiza@gmail.com',
            'senha' => '1234567',
            'confirmaSenha' => '1234567'
        ]);

        $this->simulateInput($data);

        ob_start();
        $router = new Router();
        $router->route();
        $output = ob_get_clean();

        $this->assertStringContainsString("sucesso", $output);

    }
    private function simulateInput($data)
    {
        $inputStream = fopen('php://input', 'w+');
        fwrite($inputStream, $data);
        rewind($inputStream);
        $_SERVER['HTTP_RAW_POST_DATA'] = stream_get_contents($inputStream);
        fclose($inputStream);
    }


}