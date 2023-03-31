<?php
	
	namespace App\Controllers;

	class ComunidadeController{


		public function index(){
			if(isset($_SESSION['login'])){

				if(isset($_GET['solicitarComunidade'])){
					$idPara = (int) $_GET['solicitarComunidade'];
					if(\App\Mondels\UsuariosMondel::solicitarComunidade($idPara)){
						\App\Utilidades::alerta('Comunidade solicitada com sucesso!');
						\App\Utilidades::redirect(INCLUDE_PATH.'comunidade');
					}else{
						\App\Utilidades::alerta('Ocorreu um erro ao entrar na comunidade ...');
						\App\Utilidades::redirect(INCLUDE_PATH.'comunidade');
					}
				}

			   \App\Views\MainViews::render('comunidade');
			}else{
				\App\Utilidades::redirect(INCLUDE_PATH);
			}
			
		}

	}

?>