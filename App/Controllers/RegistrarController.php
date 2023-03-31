<?php
	
	namespace App\Controllers;

	class RegistrarController{


		public function index(){

			if(isset($_POST['registrar'])){
				$nome = $_POST['nome'];
				$email = $_POST['email'];
				$senha = $_POST['senha'];
				$ultimo_post = $_POST['ultimo_post'];
				$img = $_POST['img'];

				if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
					\App\Utilidades::alerta('E-mail Inválido.');
					\App\Utilidades::redirect(INCLUDE_PATH.'registrar');
				}else if(strlen($senha) < 6){
					\App\Utilidades::alerta('Sua senha é muito curta.');
					\App\Utilidades::redirect(INCLUDE_PATH.'registrar');
				}else if(\App\Mondels\UsuariosMondel::emailExists($email)){
					\App\Utilidades::alerta('Este e-mail já existe no banco de dados!');
					\App\Utilidades::redirect(INCLUDE_PATH.'registrar');
				}else{
					//Registrar usuário.
					$senha = \App\Bcrypt::hash($senha);
					$registro = \App\MySql::connect()->prepare("INSERT INTO tb_usuarios VALUES (null,?,?,?,?,?)");
					$registro->execute(array($nome,$email,$senha,$ultimo_post,$img));

					\App\Utilidades::alerta('Registrado com sucesso!');
					\App\Utilidades::redirect(INCLUDE_PATH);
				}


			}
			
			\App\Views\MainViews::render('registrar');
			

		}

	}

?>