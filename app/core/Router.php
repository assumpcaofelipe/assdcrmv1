<?php
//Chamar os controllers pelo require_once;
require(__DIR__ . '/../controllers/HomeController.php');
require(__DIR__ . '/../controllers/ContatoController.php');
require(__DIR__ . '/../controllers/CadastroLeadController.php');
//require(__DIR__ . '/../controllers/ListaController.php');


class Router
{

    public function dispatch($url)
    {

        // Remove barras das pontas  ex: '/esportes/' → 'esportes'
        $url = trim($url, '/');

        // Divide a URL em partes    ex: 'esportes/futebol' → ['esportes', 'futebol']
        $parts = $url ? explode('/', $url) : [];


        $controllerName = $parts[0] ?? 'Home';

        $controllerName =  ucfirst($controllerName). 'Controller';


        if (!class_exists($controllerName)) {

            echo 'Opa endereço não encontrado! Tente novamente';
            exit;
        }

        $controller = new $controllerName();

        $controller->index();
    }

    
       
      
    
       
    
}
