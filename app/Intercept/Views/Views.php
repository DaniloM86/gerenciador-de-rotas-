<?php
/** CLASSE RESPONSÁVEL POR REALIZAR A INTERMEDIAÇÃO
*ENTRE AS 'VIEWS.HTML' E OS 'CONTROLLERS.PHP'*/
namespace App\Intercept\Views;
class Views{
    private static $vars = [];

    public static function init($vars = [])
    {
        self::$vars = $vars;
    }
        /** @method responsável por verificar se existe o arquivo.html e receber o conteúdo da view **/
    private static function getContentView($view)
    {
        $file = __DIR__.'/../../../resources/views/'.$view.'.html';
            return file_exists($file)  ? file_get_contents($file) : 'error';
    }
        /** @method responsável por receber e renderizar as páginas 'html'**/
    public static function render($view,$vars = [])
    {
        /** @var responsável por instânciar o getContentView **/
        $contentView = self::getContentView($view);
             $vars = array_merge(self::$vars, $vars);
                /** @var e @method responsável por receber e mapear chaves e valores das variáveis**/
            $key = array_keys($vars);
                $key = array_map(function($keys){
                    return "{{".$keys."}}";
            },$key);
            /** @method responsável por alterar as chaves pelos valores das variavéis**/
        return str_replace($key,array_values($vars),$contentView);
    }
}
