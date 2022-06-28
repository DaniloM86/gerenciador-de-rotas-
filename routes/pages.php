<?php
/**CLASSE RESPONSÁVEL POR CHAMAR AS ROTAS DO SISTEMA**/
use App\Controller\Pages;
use App\Protocol\Http\Response;
use App\Protocol\Http\Request;
use App\Intercept\Views\Views;
use App\Protocol\Http\Router;
        /** @var const que define o caminho da 'url' e da 'uri'**/
    define('URL','http://localhost/public_html');
        /** @method responsável por instânciar a função init da Intercept\views\Views.php**/
    Views::init([
        'URL' => URL
    ]);
        /** @method responsável por criar uma nova instância da classe Protocol\Http\Router.php**/
    $router = new Router(URL);
        // HOME > PAGE
        $router->get('/',[
            function(){
                return new Response(200,Pages\Home::getHome());
            }
        ]);
        // ABOUT > PAGE
        $router->get('/sobre',[
            function(){
                return new Response(200,Pages\Home::getHome());
            }
        ]);
