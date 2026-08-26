<?php


class Lead
{
    public ?int $id = null;
    public ?string $empresa_nome;
    public ?string $empresa_site = null;
    public ?string $empresa_linkedin = null;
    public ?string $decisor_nome = null;
    public ?string $decisor_cargo = null;
    public ?string $decisor_linkedin = null;
    public ?string $telefone = null;
    public ?string $email = null;
    public ?string $observacoes = null;
    public ?DateTime $primeiro_contato = null;
    public ?DateTime $proximo_contato = null;
    public ?string $status = 'novo';
    public ?string $origem = null;

    public function __construct(string $empresa_nome)
    {
          $this->empresa_nome = $empresa_nome;
    }

}

