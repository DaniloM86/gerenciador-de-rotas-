<?php
/** arquivo responsável por receber os arquivos e mostar na tela o contéudo da página**/
require __DIR__.'/vendor/autoload.php';
    include __DIR__.'/routes/pages.php';
        $router->run()->PrintResponse();
