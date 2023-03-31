<html>
    <head>
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
        <header>
              <div class="header-principal">
                   <div class="logo">
                       <img src="<?php echo INCLUDE_PATH_STATIC ?>imagens/logo.png"/>
                   </div><!--logo-->

                   <div class="header-btn">
                      <p><span><i class="fa-solid fa-house"></i> Home</span></p>

                      <p><i class="fa-solid fa-arrow-down"></i></p>
                   </div><!--header-btn-->

                   <div class="search">
                      <input type="text" name="pesquisar" placeholder="Pesquisar.."/>
                   </div><!--search-->


                   <div class="header-perfil">
                   <?php
						 if(!isset($_SESSION['me']) && $_SESSION['img'] == ''){
						?>
						<img src="<?php echo INCLUDE_PATH_STATIC ?>imagens/avatar.jpg" />
					<?php }else if(!isset($_SESSION['me'])){ ?>
						<img src="<?php echo INCLUDE_PATH ?>uploads/<?php echo $_SESSION['img'] ?>" />
					<?php } ?>
                    <?php if(isset($_SESSION['me'])){ ?>
							<span><?php echo $_SESSION['nome']; ?> </span>
						<?php }else{ ?>

							<span><?php echo $_SESSION['nome'] ?></span>

						<?php } ?>
                       
                        <a class="loggout" href="<?php echo INCLUDE_PATH ?>?loggout">loggout</a>
                        <a class="perfil" href="<?php echo INCLUDE_PATH ?>perfil"><i class="fa fa-user-o" aria-hidden="true"></i> perfil</a>
                   </div><!--header-perfil-->
              </div><!--header-pricinpal-->
        </header>
</br></br></br>

<section class="main-feed">
		
		<div class="feed">
			<div class="feed-wraper">
			<div class="feed-form">
				<form method="post" enctype="multipart/form-data">
					<textarea  name="post_content" placeholder="No que você está pensando?"></textarea>
					<input type="hidden" name="post_feed">
					<input type="submit" name="acao" value="Postar!">
				</form>
			</div><!--feed-form-->

		<?php
			$retrievePosts = \App\Mondels\HomeMondel::retrieveComunidadesPosts();

			foreach ($retrievePosts as $key => $value) {
			

		?>
			
		<div class="feed-single-post">
				<div class="feed-single-post-author">
					<div class="img-single-post-author">
						<?php
							if(!isset($value['me']) && $value['img'] == ''){
						?>
						<img src="<?php echo INCLUDE_PATH_STATIC ?>imagens/avatar.jpg" />
					<?php }else if(!isset($value['me'])){ ?>
						<img src="<?php echo INCLUDE_PATH ?>uploads/<?php echo $value['img'] ?>" />
					<?php } ?>

					<?php
						if(isset($value['me']) && $_SESSION['img'] == ''){
						?>
						<img src="<?php echo INCLUDE_PATH_STATIC ?>imagens/avatar.jpg" />
					<?php }else if(isset($value['me'])){ ?>
						<img src="<?php echo INCLUDE_PATH ?>uploads/<?php echo $_SESSION['img'] ?>" />
					<?php } ?>

					</div>
					<div class="feed-single-post-author-info">
						<?php if(isset($value['me'])){ ?>
							<h3><?php echo $_SESSION['nome']; ?> (eu)</h3>
						<?php }else{ ?>

							<h3><?php echo $value['usuario'] ?></h3>

						<?php } ?>
						<p><?php echo date('d/m/Y H:i:s',strtotime($value['data'])) ?></p>
					</div>
				</div>
				<div class="feed-single-post-content">
					<p><?php echo $value['conteudo'] ?></p>
				</div>
			</div>

		<?php } ?>

			


		</div>

			<div class="comunidades">
			<h2>Novas Pessoas</h2>

				<?php

					foreach(\App\Mondels\UsuariosMondel::listarComunidadesPendentes() as $key=>$value){
					$usuarioInfo = \App\Mondels\UsuariosMondel::getUsuarioById($value['enviou']);
				?>
				<div class="comunidade-single">
			
				
				        <img src="<?php echo INCLUDE_PATH_STATIC ?>imagens/avatar.jpg" />
						<h3><?php echo $usuarioInfo['nome'] ?></h3>
						<p><a class="aceitar" href="<?php echo INCLUDE_PATH ?>?aceitarComunidade=<?php echo $usuarioInfo['id'] ?>">Aceitar</a>  <a class="recusar" href="<?php echo INCLUDE_PATH ?>?recusarComunidade=<?php echo $usuarioInfo['id'] ?>">Recusar</a></p>
						<?php } ?>
						<a class="view-all" href="comunidade">Ver tudo</a>
				</div>
						
				</div>

				
			</div>
		</div><!--feed-->
	</section>

  <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>
    tinymce.init({ 
  	selector:'.tinymce',
  	plugins: 'image link',
  	height:300,
    menubar: 'insert',
    toolbar: 'link'
   });
  </script>

    </body>
</html>