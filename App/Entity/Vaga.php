<?php 

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Vaga {

	/**
	 * Id da vaga
	 * @var integer
	 */
	public $id;

	/**
	 * Título da vaga
	 * @var string
	 */
	public $titulo;

	/**
	 * Descição da vaga (pode conter html)
	 * @var string
	 */
	public $descricao;

	/**
	 * Define o status da vaga (ativo, desativada)
	 * @var string('ativa', 'desativada')
	 */
	public $status;

	/**
	 * Define a data de criação (timestamp)
	 * $var timestamp
	 */
	public $data;

	/**
	 * @param type $id
	 */
	public function setId($id)
	{
		$this->id = $id;
		return $this;
	}

	/**
	 * @param type $titulo
	 */
	public function setTitulo($titulo)
	{
		$this->titulo = $titulo;
		return $this;
	}

	/**
	 * @param type $descricao
	 */
	public function setDescricao($descricao)
	{
		$this->descricao = $descricao;
		return $this;
	}

	/**
	 * @param type $status
	 */
	public function setStatus($status)
	{
		$this->status = $status;
		return $this;
	}

	/**
	 * @param type $data
	 */
	public function setData($data)
	{
		$this->data = $data;
		return $this;
	}

	/**
	 * @return type
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @return type
	 */
	public function getTitulo()
	{
		return $this->titulo;
	}

	/**
	 * @return type
	 */
	public function getDescricao()
	{
		return $this->descricao;
	}

	/**
	 * @return type
	 */
	public function getStatus()
	{
		return $this->status;
	}

	/**
	 * @return type
	 */
	public function getData()
	{
		return $this->data;
	}

	/**
	 * Método responsável por atualizar a vaga no banco de dados
	 */
	public function atualizar()
	{
		return (new Database("vagas"))->update('id = '.$this->id, [
			'titulo' => $this->getTitulo(),
			'descricao' => $this->getDescricao(),
			'status' => $this->getStatus(),
			'data' => $this->getData()
		]);

	}

	/**
	 * Método responsável por cadastrar uma nova vaga
	 * @return boolen
	 */
	public function cadastrar(){
		// definir a data
		$this->setData(date("Y-m-d H:i:s"));

		// inserir vaga no banco
		$obDatabase = new Database("vagas");
		$this->id = $obDatabase->insert([
			'titulo' => $this->getTitulo(),
			'descricao' => $this->getDescricao(),
			'status' => $this->getStatus(),
			'data' => $this->getData()
		]);

		return true;
	}

	/**
	 * Método responsável por cadastrar uma nova vaga
	 * @return boolen
	 */
	public function excluir(){

		// Deletar vaga no banco
		return (new Database("vagas"))->delete('id = '.$this->id);
	}

	/**
	 * Objetos responsável por obter todas as vagas cadastradas no sistema
	 */
	public static function getVagas($fields = "*", $where = null, $order = null, $limit = null) 
	{

		return (new Database("vagas"))->select($fields, $where, $order, $limit)->fetchAll(PDO::FETCH_CLASS, self::class);

	}

	public static function getVaga($id){
		return (new Database("vagas"))->select("*", "id = " . $id)->fetchObject(self::class);
	}

}