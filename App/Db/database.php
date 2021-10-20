<?php

namespace App\Db;

use \PDO;
use \PDOException;

class Database 
{

	/**
	 * Host de conexão com o banco de dados
	 */
	const HOST = 'localhost';

	/**
	 * Nome do banco de dados
	 */
	const NAME = 'test';

	/**
	 * Usuário de acesso ao banco de dados
	 */
	const USER = 'root';

	/**
	 * Senha de acesso ao banco de dados
	 */
	const PASS = '';

	/**
	 * Nome da tabela a ser manipulada
	 * @var string
	 */
	private $table;

	/**
	 * Instância de Conexão com Banco de Dados (PDO)
	 */
	private $connection;

	/**
	 * Define a tabela e instância de conexão
	 */
	public function __construct($table = null) 
	{

		$this->table = $table;
		$this->setConnection();

	}

	/**
	 * Método responsável por criar a conexão com o banco de dados
	 */
	private function setConnection() 
	{
		try {
			$this->connection = new PDO("mysql:host=".self::HOST.";dbname=".self::NAME.";", self::USER, self::PASS);
			$this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			die("ERROR: ".$e->getMessage());
		}
	}

	/**
	 * Método responsável por executar querys no banco de dados
	 */
	public function execute($query, $params = [])
	{
		try {
			$stmt = $this->connection->prepare($query);
			$stmt->execute($params);
			return $stmt; 
		} catch (PDOException $e) {
			die("ERROR: ".$e->getMessage());
		}
		
	}

	/**
	 * Método responsável por inserir dados no banco de dados
	 * @param array
	 * @return integer
	 */
	public function insert($values) 
	{

		// Dados da query
		$fields = array_keys($values);
		$binds = array_pad([], count($fields), '?');

		// Query
		$stmt = "INSERT INTO ".$this->table." (".implode(', ', $fields).") VALUES (".implode(', ', $binds).");";

		// Executa o insert
		$this->execute($stmt, array_values($values));

		// Retorna o último id inserido
		return $this->connection->lastInsertId();
	}

	/**
	 * Método responsável por executar uma consulta no banco
	 */
	public function select($fields = "*", $where = null, $order = null, $limit = null)
	{

		$where = strlen($where) ? "WHERE ".$where : "";
		$order = strlen($order) ? "ORDER BY ".$order : "";
		$limit = strlen($limit) ? "LIMIT ".$limit : "";

		$stmt = "SELECT ".$fields." FROM ".$this->table." ".$where." ".$order." ".$limit.";";

		return $this->execute($stmt);
	}

	/**
	 * Método responsável por atualizar
	 * os dados no banco de dados
	 */
	public function update($where, $values)
	{
		// campos
		$fields = array_keys($values);

		// query
		$stmt = "UPDATE ".$this->table." SET ".implode(' = ?, ', $fields)." = ? WHERE ".$where.";";

		// executar query
		$this->execute($stmt, array_values($values));

		return $this;
	}

	/**
	 * Método responsável por deletar
	 * dados no banco de dados
	 */
	public function delete($where)
	{
		// query
		$stmt = "DELETE FROM ".$this->table." WHERE ".$where.";";

		// executar query
		$this->execute($stmt);

		return $this;
	}
}