<?php
/*
 *	Classe responsavel pela conexão com o banco de dados
 */


class Conexao {

	protected $endereco = "localhost";
	protected $usuario = "admin";
	protected $senha = "2013life";
	
	protected $con;
	protected $rs;

	protected $uidEditAlbum;
	
	public function criar() {
		$this->con = mysql_connect($this->endereco, $this->usuario, $this->senha) or die("Impossivel conectar");
		mysql_set_charset('utf8', $this->con);
	}
	
	public function executar($consulta) {
		$this->rs = mysql_query($consulta, $this->con);
	}
	
	public function qtde() {
		return mysql_num_rows($this->rs);
	}
	
	public function proxima() {
		return mysql_fetch_array($this->rs);
	}
	
	public function cadalbum($nome,$email,$senha,$evento,$descricao) {
		$consulta = "CALL cadastro_cliente('$nome','$email','$senha','$evento','$descricao');";
		$rs = mysql_query($consulta, $this->con);
		$rst = mysql_fetch_array($rs);
		$id = $rst["id"];
		
		return $id;
	}
	
	public function cadpasta($nome,$id) {
		$consulta = "CALL criacao_pasta('$nome','$id');";
		mysql_query($consulta, $this->con);
	}
	
	public function adicao_de_fotos($nome,$id) {
		$consulta = "CALL adicao_de_fotos('$nome','$id');";
		mysql_query($consulta, $this->con);
	}
	
	public function fechar() {
		mysql_close($this->con);
	}

	public function setUidEditAlbum($id){
		$this->uidEditAlbum = $id;
		return true;
	}

	public function getUidEditAlbum(){
		//return $this->uidEditAlbum;
		return 1;
	}
	
	public function selecionar() {
		mysql_select_db("life", $this->con);
	}
	
	public function login($email,$senha) {
		$consulta = "CALL login('$email','$senha');";
		$this->rs = mysql_query($consulta, $this->con);
	}
}
?>
