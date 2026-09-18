<?php

require_once __DIR__ . '/../core/Controller.php';

class HomeController extends Controller
{

  public function index()
  {
     
   // Simulando dados vindo do model

    $nome = 'Felipe Assumpção';
    $profissao = 'Desenvoledor';
     

    $this->render('home', ['nome'=> $nome]);
    
  }

}