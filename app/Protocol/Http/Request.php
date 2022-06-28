<?php
/**CLASSE RESPONSÁVEL POR INFORMAR O TIPO DE REQUISIÇÃO FEITA PELO USUÁRIO**/
namespace App\Protocol\Http;
class Request{
/** @var group
* atributos responsável por receber valores
* e o header da Request
**/
    private $httpMethod  = '';
    private $uri         = '';
    private $queryParams = [];
    private $postVars    = [];
    private $headers     = [];
        /** @method construtor da classe**/
    public function __construct()
    {
        $this->queryParams = $_GET ?? [];
            $this->postVars = $_POST ?? [];
                $this->headers = getallheaders();
                    $this->httpMethod = $_SERVER['REQUEST_METHOD'] ?? "";
                        $this->uri = $_SERVER['REQUEST_URI'] ?? "";
    }
/**
* @method group
* métodos responsáveis por retornar os valores de cada atributo
*/
    public function getHttpMethod()
    {
        return $this->httpMethod;
    }
    public function getUri()
    {
        return $this->uri;
    }
    public function getQueryParams()
    {
        return $this->queryParams;
    }
    public function getPostVars()
    {
        return $this->postVars;
    }
    public function getHeaders()
    {
        return $this->headers;
    }

}
