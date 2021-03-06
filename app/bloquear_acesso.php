<?php

include 'conexao.php';
include 'MailSender.php';

class BloquearAcesso{

	protected $id;
	protected $solicitadoPor;
	
	public function bloquear($id) {
		$con = new Conexao;
		$con->criar();
		$con->selecionar();
		$con->executar("UPDATE cliente SET acesso = 0 WHERE id = $id;");
		$con->fechar();
	}

	public function setId($id){
		$this->id = $id;
	}

	public function setQuem($who){
		$this->solicitadoPor = $who;
	}

	public function getId(){
		return $this->id;
	}

	public function getQuem(){
		return $this->solicitadoPor;
	}
	
	public function enviarEmail($nome){
		$email = new MailSender;

		$email->setDestino("bismarck.sc@gmail.com");
		$email->setAssunto("Triagem Finalizada!");
		$email->setMensagem("O cliente $nome concluiu a triagem de fotos.");
		$email->enviarMensagem();
	}
}

session_start();

$ba = new BloquearAcesso;
$ba->setId($_POST["acesso"]);
$ba->setQuem($_POST["solicitante"]);
$ba->bloquear($ba->getId());

if($ba->getQuem() == 1){
	header("Location: ../admin.html");
}
else if($ba->getQuem() == 0){
	$ba->enviarEmail($_POST["nome"]);
	header("Location: logout.php");
}
?>
