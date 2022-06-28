<?php
/**CLASSE RESPONSÁVEL PELO CONTROLLER
*FIXO DE CABEÇALHO, DO CONTEÚDO, E DO RODA PÉ DO SISTEMA
*/
namespace App\Controller\Pages;
use App\Intercept\Views\Views;
class Master{
        /** @method responsável por receber conteúdo do cabeçalho**/
    private static function getHeader()
    {
        return Views::render("pages/header");
    }
        /** @method responsável por receber o conteúdo do roda pé do sistema**/
    private static function getFooter()
    {
        return Views::render("pages/footer");
    }
        /** @method responsável por receber o conteúdo de forma dinâmica das páginas**/
    public function getPages($title,$content)
    {
            /** @return views do html**/
        return Views::render('pages/master',[
            "title" => $title,
                "header" => self::getHeader(),
                    "content" => $content,
                        "footer" => self::getFooter()
        ]);
    }
}
