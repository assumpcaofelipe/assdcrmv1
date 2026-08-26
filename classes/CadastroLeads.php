<?php

require_once 'Lead.php';

class CadastroLeads
{
  private $pdo;

  public function __construct(PDO $pdo)
  {
    $this->pdo = $pdo;
  }



  private function leadVerificado(Lead $lead)
  {
    $sql = "SELECT 1 FROM leads WHERE empresa_nome = :empresa_nome LIMIT 1";
    $sql = $this->pdo->prepare($sql);;
    $sql->bindValue(':empresa_nome', $lead->empresa_nome);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      return true;
    } else {
      return false;
    }

     
  }


  public function criarLead(Lead $lead) 
  {
    if($this->leadVerificado($lead) === false){
       $sql = "INSERT INTO leads(
            empresa_nome,
            empresa_site,
            decisor_nome,
            decisor_cargo,
            decisor_linkedin,
            telefone,
            email,
            observacoes,
            primeiro_contato,
            proximo_contato,
            status,
            origem
       )
        VALUES (
        :empresa_nome, 
        :empresa_site,
        :decisor_nome,
        :decisor_cargo,
        :decisor_linkedin,
        :telefone,  
        :email,
        :observacoes,
        :primeiro_contato,
        :proximo_contato,
        :status,
        :origem
        )";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(':empresa_nome', $lead->empresa_nome);
        $sql->bindValue(':empresa_site', $lead->empresa_site);
        $sql->bindValue(':decisor_nome', $lead->decisor_nome);
        $sql->bindValue(':decisor_cargo', $lead->decisor_cargo);
        $sql->bindValue(':decisor_linkedin', $lead->decisor_linkedin);
        $sql->bindValue(':telefone', $lead->telefone);
        $sql->bindValue(':email', $lead->email !== '' ? $lead->email : null, $lead->email !== '' ? PDO::PARAM_STR : PDO::PARAM_NULL);
        $sql->bindValue(':observacoes', $lead->observacoes);
        $sql->bindValue(':primeiro_contato', $lead->primeiro_contato?->format('Y-m-d H:i:s'));
        $sql->bindValue(':proximo_contato', $lead->proximo_contato?->format('Y-m-d H:i:s'));
        $sql->bindValue(':status', $lead->status);
        $sql->bindValue(':origem', $lead->origem);
        $sql->execute();
        return true;

    } else {
        return false;
    }
  }



  public function retornarListaLeads(): array
  {
    $sql = "SELECT * FROM leads";
    $sql = $this->pdo->query($sql);

    if ($sql->rowCount() > 0) {
      return $sql->fetchAll(PDO::FETCH_ASSOC);
    } else {
      return array();
    }
  }


public function buscarLeadporStatus(string $status): array
{
  $sql = "SELECT * FROM leads WHERE status = :status";
  $sql = $this->pdo->prepare($sql);
  $sql->bindValue(':status', $status);
  $sql->execute();
  return $sql->fetchAll(PDO::FETCH_ASSOC);
  
  }
 



  public function buscarLeadPorId(int $id): ?Lead
{
    $sql = "SELECT * FROM leads WHERE id = :id LIMIT 1";
    $sql = $this->pdo->prepare($sql);
    $sql->bindValue(':id', $id);
    $sql->execute();

    $dados = $sql->fetch(PDO::FETCH_ASSOC);

    if (!$dados) {
        return null;
    }

    $lead = new Lead($dados['empresa_nome']);

    $lead->id = (int) $dados['id'];
    $lead->empresa_site = $dados['empresa_site'];
    $lead->empresa_linkedin = $dados['empresa_linkedin'];
    $lead->decisor_nome = $dados['decisor_nome'];
    $lead->decisor_cargo = $dados['decisor_cargo'];
    $lead->decisor_linkedin = $dados['decisor_linkedin'];
    $lead->telefone = $dados['telefone'];
    $lead->email = $dados['email'];
    $lead->observacoes = $dados['observacoes'];

    $lead->primeiro_contato = !empty($dados['primeiro_contato'])
        ? new DateTime($dados['primeiro_contato'])
        : null;

    $lead->proximo_contato = !empty($dados['proximo_contato'])
        ? new DateTime($dados['proximo_contato'])
        : null;

    $lead->status = $dados['status'];
    $lead->origem = $dados['origem'];

    return $lead;
}

public function retornarListaLeadsPaginados(int $limite, int $offset)
{
  $sql = "SELECT * FROM leads ORDER BY id LIMIT :limite OFFSET :offset";
  $sql = $this->pdo->prepare($sql);
  $sql->bindValue(':limite', $limite, PDO::PARAM_INT);
  $sql->bindValue(':offset', $offset, PDO::PARAM_INT);
  $sql->execute();

  return $sql->fetchAll(PDO::FETCH_ASSOC);

}

public function contarLeads()
{
   $sql = "SELECT COUNT(*) FROM leads";
   $sql = $this->pdo->query($sql);
   
   return $sql->fetchColumn();
}


 public function EditarLead(Lead $lead)
 {

  $sql = "UPDATE leads SET
                empresa_nome = :empresa_nome,
                empresa_site = :empresa_site,
                decisor_nome = :decisor_nome,
                decisor_cargo = :decisor_cargo,
                decisor_linkedin = :decisor_linkedin,
                telefone = :telefone,
                email = :email,
                observacoes = :observacoes,
                primeiro_contato = :primeiro_contato,
                proximo_contato = :proximo_contato,
                status = :status,
                origem = :origem
            WHERE id = :id";

    $sql = $this->pdo->prepare($sql);

    $sql->bindValue(':id', $lead->id);
    $sql->bindValue(':empresa_nome', $lead->empresa_nome);
    $sql->bindValue(':empresa_site', $lead->empresa_site);
    $sql->bindValue(':decisor_nome', $lead->decisor_nome);
    $sql->bindValue(':decisor_cargo', $lead->decisor_cargo);
    $sql->bindValue(':decisor_linkedin', $lead->decisor_linkedin);
    $sql->bindValue(':telefone', $lead->telefone);
    $sql->bindValue(':email', $lead->email);
    $sql->bindValue(':observacoes', $lead->observacoes);
    $sql->bindValue(
        ':primeiro_contato',
        $lead->primeiro_contato?->format('Y-m-d H:i:s')
    );
    $sql->bindValue(
        ':proximo_contato',
        $lead->proximo_contato?->format('Y-m-d H:i:s')
    );
    $sql->bindValue(':status', $lead->status);
    $sql->bindValue(':origem', $lead->origem);

    return $sql->execute();
 
 }

 public function excluirLead($id)
 {
    $sql = "DELETE FROM leads WHERE id = :id";
    $sql = $this->pdo->prepare($sql);
    $sql->bindValue(':id', $id);
    $sql->execute();
 }

}
