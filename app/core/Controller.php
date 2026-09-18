<?php

class Controller
{

    /*
    |--------------------------------------------------------------------------
    | Método render
    |--------------------------------------------------------------------------
    |
    | Responsável por carregar/renderizar uma view da aplicação.
    |
    | Exemplo:
    | $this->render('home');
    |
    | O método irá procurar o arquivo:
    | app/views/home.php
    |
    */

    protected function render($view, $viewData = [])
    {
        
         //Extraindo o array

         extract($viewData);
    
        $viewFile = __DIR__  . '/../views/' . $view . '.php';
        if (!file_exists($viewFile)) {
            throw new Exception('Esta pagina não existe!');
        }
        
        //dump($viewData);
        require_once $viewFile;
    }

    
}
