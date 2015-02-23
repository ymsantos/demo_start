<?php
	include 'app/conexao.php';

	$id = $_GET["id"];
	
	$con = new Conexao;
	
	$con->criar();
	$con->selecionar();
	$con->executar("SELECT nome FROM pasta WHERE id = '$id';");
	
	$rst = $con->proxima();
	$nome = $rst["nome"];
	$con->fechar();
	
	session_start();
	
	$_SESSION["c_pasta_id"] = $id;
    $_SESSION["c_pasta_nome"] = $nome;
?>

<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie ie6 no-js" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" lang="en"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" lang="en"><!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <title>Life - Triagem de fotos (Administrador)</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="author" content="Dark Horses" />
        <link rel="shortcut icon" href="../favicon.ico">
        <link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/styles.css" />
		<link rel="stylesheet" type="text/css" href="css/demo.css" />
		<script type="text/javascript" src="js/modernizr.custom.86080.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="css/reset.css" media="screen" />
		<link rel="stylesheet" href="css/style.css" media="screen" />
		<link rel="stylesheet" href="css/css3_3d.css" media="screen" />
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/modernizr.js"></script>
		
		 <!--[if lt IE 9]>
          <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

		<script>
			if (!Modernizr.csstransforms) {
				$(document).ready(function(){
					$(".close").text("Back to top");
				});
			}
		</script>
    </head>
    <body>
    	<div class="codrops-top">
            <a href="admin.html">
                <strong>Inicio</strong>
            </a>
            <span class="right">
            	<strong style="font-weight: bold;">Seja Bem-Vindo ADMINISTRADOR!</strong> <a href="app/logout.php">sair</a>
            </span>
            <div class="clr"></div>
        </div>
        
        <div class="container">
        	<h1 id="logo">
            <img src="images/life_logo.png"/>
            </h1>
        </div>

        <div id="container">
        	<h2 class="title"><span>Sistema de Triagem de Fotos<br>Adicionar fotos à pasta "<?php $name = explode("-", $nome, 2); echo $name[1]; ?>"</span></h2>
    	</div>
		
		<?php
			$con->criar();
			$con->selecionar();
			$con->executar("SELECT c.id, c.nome FROM cliente c, cliente_pasta WHERE id_pasta = $id AND id_cliente = c.id");
	
			$rst = $con->proxima();
			$idCliente = $rst["id"];
			$nome = $rst["nome"];
			$con->fechar();
			
			$_SESSION["c_album_id"] = $idCliente;
		?>

		<br>
		<div class="container">
			<a class="btn" href="editar_album.php?id=<?php echo $idCliente; ?>&nome=<?php echo $rst['nome']; ?>">Voltar</a>
        </div>

		<div id="dropbox">
			<span class="message">Arraste e solte as imagens aqui.</span>
		</div>
        
		<!--<?php
			$con->criar();
			$con->selecionar();
			$con->executar("SELECT c.id, c.nome FROM cliente c, cliente_pasta WHERE id_pasta = $id AND id_cliente = c.id");
	
			$rst = $con->proxima();
			$idCliente = $rst["id"];
			$nome = $rst["nome"];
			$con->fechar();
			
			$_SESSION["c_album_id"] = $idCliente;
		?> -->

        <div class="container">
			<a class="btn" href="editar_album.php?id=<?php echo $idCliente; ?>&nome=<?php echo $rst['nome']; ?>">Voltar</a>
        </div>
        
        <!-- Including The jQuery Library -->
		<script src="http://code.jquery.com/jquery-1.6.3.min.js"></script>
		
		<!-- Including the HTML5 Uploader plugin -->
		<script src="assets/js/jquery.filedrop.js"></script>
		
		<!-- The main script file -->
        <script src="assets/js/script.js"></script>
    </body>
</html>
