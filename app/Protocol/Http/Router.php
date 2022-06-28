<?php
/** CLASSE RESPONSÁVEL POR GERENCIAR AS ROTAS E MÉTODOS DO SISTEMA**/
namespace App\Protocol\Http;
use \Closure;
use \Exception;
class Router{
/** @var group
* atributos responsável por receber valores da classe
**/
    private $url = '';
    private $prefix = '';
    private $routes = [];
    private $request;
        /** @method construtor da classe**/
    public function __construct($url)
    {
        $this->request = new Request();
            $this->url = $url;
                $this->setPrefix();
    }
        /** @method responsável por definir o prefixo da url**/
    public function setPrefix()
    {
        $parseUrl = parse_url($this->url);
            $this->prefix = $parseUrl['path'] ?? '';

    }
        /** @method responsável por definir as métodos as rotas e os parâmetros**/
    private function addRouter($method,$route,$params = [])
    {
        foreach ($params as $key => $value) {
            if($value instanceof Closure){
                $params['controller'] = $value;
                    unset($params[$key]);
            }
        }
        $pattern = str_replace('/','\/',$route);
            $patternRoute = '/^'.$pattern.'$/';
                $this->routes[$patternRoute][$method] = $params;
    }
        /** @method responsável por @return método GET**/
    public function get($route,$params = [])
    {
        return $this->addRouter('GET',$route,$params);
    }
        /** @method responsável por @return método POST**/
    public function post($route,$params = [])
    {
        return $this->addRouter('POST',$route,$params);
    }
        /** @method responsável por @return método PUT**/
    public function put($route,$params = [])
    {
        return $this->addRouter('PUT',$route,$params);
    }
        /** @method responsável por @return método DELETE**/
    public function delete($route,$params = [])
    {
        return $this->addRouter('DELETE',$route,$params);
    }
        /** @method responsável por definir o valor da uri e desconsiderar o prefixo da url**/
    private function getContentUri()
    {
        $uri = $this->request->getUri();
            $explodeUri = strlen($this->prefix) ? explode($this->prefix,$uri) : [$uri];
                return end($explodeUri);
    }
        /** @method responsável por receber os valor da rotas**/
    private function getRoutes()
    {
        $uri = $this->getContentUri();
            $httpMethod = $this->request->getHttpMethod();
                foreach ($this->routes as $patternRoute => $methods) {
                    if(preg_match($patternRoute,$uri)) {
                        if(isset($methods[$httpMethod])) {
                            return $methods[$httpMethod];
                    }
                throw new Exception("Error 405: Method not allowed",405);
            }
        }
            throw new Exception("Error 404: page not found", 404);
    }
        /** @method responsável por retornar na tela a resposta ao usuário**/
    public function run()
    {
        try {
            $routes = $this->getRoutes();
                if (!isset($routes['controller'])) {
                    throw new Exception("Error 500: Internal server error", 500);
                }
                    $args = [];
                        return call_user_func_array($routes['controller'],$args);
            }catch (Exception $e) {
                return new Response($e->getCode(),$e->getMessage());
        }
    }
}
