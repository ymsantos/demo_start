<?php
    include 'app/conexao.php';

    session_start();
    //$id = $_SESSION["e_album_id"];
    $id = $_GET["id"];
    $nome = $_GET["nome"];
    $_SESSION["e_album_id"] = $id;
    $_SESSION["c_album_id"] = $id;
    $_SESSION["e_album_nome_cliente"] = $nome;
    
    $con = new Conexao;
    
    $con->criar();
    $con->selecionar();
    $con->executar("SELECT p.id, p.nome FROM cliente_pasta c, pasta p WHERE c.id_pasta = p.id AND c.id_cliente = '$id';");
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
		<link rel="stylesheet" type="text/css" href="css/demo.css" />
		<script type="text/javascript" src="js/modernizr.custom.86080.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="css/reset.css" media="screen" />
		<link rel="stylesheet" href="css/style.css" media="screen" />
        <link rel="stylesheet" href="css/css3_3d.css" media="screen" />
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/modernizr.js"></script>

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
            <h2 class="title"><span>Sistema de Triagem de Fotos<br>Editar álbum de <?php echo $nome; ?></span></h2>
            <br><br>
    		<label>Pastas:</label>
            <br>
            <?php
            $qtde = $con->qtde();
            if($qtde > 0) { ?>
                <form class="form-horizontal" role="form">
                <table>
            <?php
                for($i = 0; $i < $qtde; $i++) {
                    $rst = $con->proxima();
            ?>
            
                    <tr>
                    <!--<form class="form-horizontal" role="form">-->
                    <td class="span2"><?php $name = explode("-", $rst["nome"], 2); echo $name[1]; ?></td><td><a href="adicionar_fotos_2.php?id=<?php echo $rst['id']; ?>" class="btn btn-small">Adicionar fotos</a></td><td><a href="excluir_fotos.php?id=<?php echo $rst['id']; ?>&unome=<?php echo $nome; ?>&nome=<?php echo $rst['nome']; ?>&pag=1" class="btn btn-small">Excluir fotos</a></td><td><a href="excluir_pasta.php?id=<?php echo $rst['id']; ?>" class="btn btn-small">Excluir pasta</a></td>
                    <!--</form>-->
                    </tr>
            
            <?php
            } ?>
                </table>
                </form>
        <?php       
            }
            $con->fechar();
        ?>
    	</div>
        <br>
        <div id="container">
            <!--
			<form class="form-horizontal" role="form">
				<input type="text" class="form-control" id="" placeholder="Insira o nome">
				<button type="submit" class="btn btn-default">Criar Pasta</button>
			</form>	
			
			<button type="submit" class="btn btn-default">Finalizar</button> -->
            <form class="form-horizontal" role="form" method="post" action="app/editar_album.php">
                <input type="text" class="form-control" name="txtnome" placeholder="Insira o nome da pasta">
                <button type="submit" class="btn btn-default">Criar pasta</button>
            </form> 
            <br>
			<a href="editar_infos.php?id=<?php echo $id; ?>&nome=<?php echo $nome; ?>" class="btn btn-default">Editar informações</a>
			<a href="selec_capa.php?id=<?php echo $id; ?>&nome=<?php echo $nome; ?>&pag=1" class="btn btn-default">Selecionar capa</a>
            <a href="bloquear_acesso.php?id=<?php echo $id; ?>&nome=<?php echo $nome; ?>" class="btn btn-default">Bloquear acesso</a>
            <a href="excluir_album.php?id=<?php echo $id; ?>&nome=<?php echo $nome; ?>" class="btn btn-default">Excluir álbum</a>
        </div>
        <br><br>
        <div class="container">
            <a href="pendentes.php" class="btn btn-default">Voltar</a>
        </div>
    </body>
</html>
