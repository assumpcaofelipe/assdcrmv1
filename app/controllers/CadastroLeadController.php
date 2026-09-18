<?php

require_once __DIR__ . '/../core/Controller.php';

class CadastroLeadController extends Controller
{

    public function index()
    {
        $this->render('cadastro');
    }

}