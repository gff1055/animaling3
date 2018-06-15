<?php
namespace App\Models;

class Animal{
	
	//private $codigoDono;
	private $codigo;
	private $nome;
	private $especie;
	private $nascimento;
	private $descricao;
	private $sexo;
	private $nick;
	private $email;
	
	function Animal()
	{
		
	}
	
	public function getCodigoDono(){
		return $this->codigoDono;
	}
	
	public function setCodigoDono($pCodigoDono){
		$this->codigoDono = $pCodigoDono;
	}
	
	public function getCodigo(){
		return $this->codigo;
	}
	
	public function setCodigo($pCodigo){
		$this->codigo = $pCodigo;
	}
	

	public function getNick(){
		return $this->nick;
	}
	
	public function setNick($pNick){
		$this->nick = $pNick;
	}

	public function getNome(){
		return $this->nome;
	}
	
	public function setNome($pNome){
		$this->nome = $pNome;
	}

	public function getDescricao(){
		return $this->descricao;
	}
	
	public function setDescricao($pDescricao){
		$this->nome = $pDescricao;
	}
	
	public function getEmail(){
		return $this->email;
	}
	
	public function setEmail($pEmail){
		$this->email = $pEmail;
	}

	public function getSexo(){
		return $this->sexo;
	}
	
	public function setSexo($pSexo){
		$this->sexo = $pSexo;
	}
	
	public function getNascimento(){
		return $this->nascimento;
	}
	
	public function setNascimento($pNascimento){
		$objAuxData = new DateTime($pNascimento);
		$this->nascimento = $objAuxData->format('y/m/d');
	}
}
?>