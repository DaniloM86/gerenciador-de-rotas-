<?php
/**CLASSE RESPONSÁVEL POR RETORNAR A RESPOSTA DA REQUISIÇÃO FEITA PELO USUÁRIO**/
namespace App\Protocol\Http;
class Response{
/** @var group
* atributos responsável por receber valores
* e o header da Response
**/
    private $httpCode    = 200;
    private $contentType = "text/html";
    private $headers     = [];
    private $content;
        /** @method construtor da classe**/
    public function __construct($httpCode,$content,$contentType = "text/html")
    {
        $this->httpCode = $httpCode;
            $this->content = $content;
                $this->setContentType($contentType);
    }
        /** @method responsável por receber o valor do contentType**/
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
            $this->addHeaders("Content-Type",$contentType);
    }
        /** @method responsável por adicionar o valor do contentType cabeçalho do response**/
    private function addHeaders($key,$value)
    {
        return $this->headers[$key] = $value;
    }
        /** @method responsável por informar o código de status do response para o navegador**/
    private function infoNavigator()
    {
        http_response_code($this->httpCode);
        foreach ($this->headers as $key => $value) {
            header($key.": ".$value);
        }
    }
        /** @method responsável por exibir na tela o conteúdo do response**/
    public function PrintResponse()
    {
        $this->infoNavigator();
        switch ($this->contentType) {
            case "text/html":
                echo $this->content;
                    exit;
        }
    }
}
