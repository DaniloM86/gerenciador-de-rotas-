<?php
    /**CLASSE RESPONSÁVEL PELO CONTROLLER DA PÁGINA HOME*/
namespace App\Controller\Pages;
use App\Intercept\Views\Views;
use App\Model\Database\Database;
class Home extends Master{
        /** @method reponsável por retornar o conteúdo da página home */
    public static function getHome()
    {
        $obModel = new Database();
            /** @var array responsável por receber todas as informações vindas do banco de dados **/
        $content = Views::render("pages/home",[
            "subTitleMenu" => $obModel->subTitle,
                "titleBanner"  => " i am a banner",
                    "textDescription" => $obModel->textDescription,
                        "valueOne" => "R$ 23,99",
                            "valueTwo" => "R$ 29,90",
                                "valueThree" => "R$ 34,99",
                            "valueFour" => "R$ 45,90",
                        "imgOne" => "assets/img/livro_eight.png",
                    "imgTwo" => "assets/img/livro_two.png",
                "imgThree" =>  "assets/img/livro_seven.png",
            "imgfour" => "assets/img/livro_six.png"
        ]);
        return parent::getPages('page > home',$content);
    }
}
