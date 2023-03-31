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
			<div class="comunidade">
			<div class="container-comunidade">
					<h4>Comunidades que estou</h4>
					<div class="container-comunidade-wraper">
						<?php foreach(\App\Mondels\UsuariosMondel::listarComunidades() as $key => $value){ ?>
						<div class="container-comunidade-single">
							<div class="img-comunidade-user-single">
								<?php
									if($value['img'] == ''){
								?>
								<img src="<?php echo INCLUDE_PATH_STATIC ?>imagens/avatar.jpg" />

							<?php }else{ ?>
								<img src="<?php echo INCLUDE_PATH ?>uploads/<?php echo $value['img'] ?>" />
							<?php } ?>
							</div>
							<div class="info-comunidade-user-single">
								<h2><?php echo $value['nome']; ?></h2>
								
							</div>

						</div>

					<?php } ?>
						
						
					</div>
			</div>
			<br/>

				<div class="container-comunidade">
					<h4>Comunidades</h4>
					<div class="container-comunidade-wraper">

						<?php
							$comunidade = \App\Mondels\UsuariosMondel::listarComunidade();

							foreach ($comunidade as $key => $value) {

								$pdo = \App\MySql::connect();
								$verificarAmizade = $pdo->prepare("SELECT * FROM comunidades WHERE (enviou = ? AND recebeu = ? AND status = 1) OR (enviou = ? AND recebeu = ? AND status = 1)");


								$verificarAmizade->execute(array($value['id'],$_SESSION['id'],$_SESSION['id'],$value['id']));
								if($verificarAmizade->rowCount() == 1){
									//Já são amigos, não existe necessidade de listar.
									continue;
								}


								if($value['id'] == $_SESSION['id']){
									continue;
								}
							
						?>


						<div class="container-comunidade-single">
							<div class="img-comunidade-user-single">
								<img src="<?php echo INCLUDE_PATH_STATIC ?>imagens/avatar.jpg" />
							</div>
							<div class="info-comunidade-user-single">
								<h2><?php echo $value['nome']; ?></h2>
								
							<div class="btn-solicitar-amizade">
								<?php
									if(\App\Mondels\UsuariosMondel::existePedidoComunidades($value['id'])){
								?>
								<a href="<?php echo INCLUDE_PATH ?>comunidade?solicitarComunidade=<?php echo $value['id']; ?>">Solicitar Comunidade</a>
							<?php }else{ ?>
								<a href="javascript:void(0);" style="color:orange;border: 0;">pedido pendente</a>
							<?php } ?>
							</div>
							</div>

						</div>

					<?php } ?>
						
					</div>
			</div>
			    <div class="btn-voltar">
			     <a  href="home">Voltar</a>
			    </div><!--btn-voltar-->
			</div>
              
    
		</div><!--feed-->
	</section>


</body>


</html>