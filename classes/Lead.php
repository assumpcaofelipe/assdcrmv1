<?php


class Lead
{

private static $db;


public static function getConnection()
{
 
  if(empty(self::$db)){
    $ini = parse_ini_file('config/assdpainel.ini');
    $host = $ini['host'];
    $name = $ini['name'];
    $user = $ini['user'];
    $pass = $ini['pass'];
    self::$db = new PDO("mysql:host={$host};dbname={$name};charset=utf8mb4", "{$user}", "$pass");
    self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

  return self::$db;



}

/**
     * Busca uma pessoa no banco de dados pelo seu ID.
     *
     * Abre uma conexão direta com o banco via PDO, executa uma
     * consulta preparada (protegida contra SQL Injection) e
     * retorna os dados da pessoa encontrada como um array associativo.
     *
     * @param int|string $id ID da pessoa a ser buscada na tabela "lead".
     *
     * @return array|false Array associativo com os dados da lead
     *                      (colunas da tabela como chaves), ou false
     *                      caso nenhum registro seja encontrado.
     */


public static function find($id)
{
    $db = self::getConnection();
    $sql = 'SELECT * FROM leads WHERE id = :id';
    $sql = $db->prepare($sql);
    $sql->bindValue(':id', $id);
    $sql->execute();
    $lead = $sql->fetch(PDO::FETCH_ASSOC);
    return $lead;

}

 /**
     * Remove uma pessoa do banco de dados pelo seu ID.
     *
     * Abre uma conexão com o banco via PDO, ativa o modo de exceção para
     * capturar erros de forma explícita, e executa um DELETE na tabela
     * "pessoa" usando uma consulta preparada (protegida contra SQL Injection).
     *
     * @param int|string $id ID da pessoa a ser removida da tabela "pessoa".
     *
     * @return bool true se a exclusão foi executada com sucesso, false caso contrário.
     */


  public static function delete($id)
  {
    $db = self::getConnection();
    $sql = 'DELETE FROM leads WHERE id = :id';
    $sql = $db->prepare($sql);
    $sql->bindValue(':id', $id);
    return $sql->execute;
  }
  

   /**
     * Retorna todas as pessoas cadastradas no banco de dados.
     *
     * Executa uma consulta simples na tabela "leads", ordenada pelo ID,
     * e retorna todos os registros encontrados.
     *
     * @return array Array de arrays associativos, cada um representando
     *               uma pessoa (colunas da tabela como chaves). Retorna
     *               um array vazio caso não existam registros.
     */


  public static function all()
  {
     $db = self::getConnection();
     $sql = 'SELECT * FROM leads ORDER by id';
     $sql = $db->prepare($sql);
     $sql->execute();
     $list = $sql->fetchAll(PDO::FETCH_ASSOC);
     return $list;
  }



}

