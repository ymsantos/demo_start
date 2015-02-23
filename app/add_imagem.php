<?php
include 'conexao.php';

class AddImg {
	protected $nome;
	protected $id;
	
	public function setnome($nome) {
		$this->nome = $nome;
	}
	
	public function setid($id) {
		$this->id = $id;
	}
	
	public function criar() {
		$con = new Conexao;

		$con->criar();
		$con->selecionar();
		$id = $con->adicao_de_fotos($this->nome,$this->id);
		$con->fechar();
	}
}
?>

