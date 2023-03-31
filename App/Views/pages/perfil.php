<!DOCTYPE html>
<html>
<head>
	<!--ALTERAR TITULO-->
	<title>Bem-vindo, <?php echo $_SESSION['nome']; ?></title>
    <script src="https://kit.fontawesome.com/5506a4acb1.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap" rel="stylesheet">
	<link href="<?php echo INCLUDE_PATH_STATIC ?>css/style.css" rel="stylesheet"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Norian Henrique - NADSistemas">
    <meta charset="utf-8" />



</head>

<body>

	<section class="main-feed">
		
		<div class="feed">
			
			<div class="editar-perfil">
				<h2>Editando Perfil:</h2>
				<br/>
				<?php
					if(isset($_SESSION['img']) && $_SESSION['img'] == ''){
						echo '<img style="max-width:400px;width:100%;" src="'.INCLUDE_PATH_STATIC.'imagens/avatar.jpg" />';
					}else{
					echo '<img style="max-width:400px;width:100%;" src="'.INCLUDE_PATH.'uploads/'.$_SESSION['img'].'" />';
					}
				?>
				<br/>
                <br/>
                <br/>
				<form method="post" enctype="multipart/form-data">
					<input type="text" name="nome" value="<?php echo $_SESSION['nome'] ?>">
					<input type="password" name="senha" placeholder="Sua nova senha...">
					<input type="file" name="file">
					<input type="hidden" name="atualizar" value="atualizar">
					<input type="submit" name="acao" value="Salvar!">
				</form>
				<div class="btn-voltar">
			       <a  href="home">Voltar</a>
			    </div><!--btn-voltar-->
			</div>
		</div><!--feed-->
	</section>


</body>
