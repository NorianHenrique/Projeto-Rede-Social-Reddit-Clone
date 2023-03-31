<?php
	
	namespace App\Controllers;

	class PerfilController{
      
        public function index(){
             
            if(isset($_SESSION['login'])){
                 
                if(isset($_POST['atualizar'])){
					$pdo = \App\MySql::connect();
					$nome = strip_tags($_POST['nome']);
					$senha = $_POST['senha'];

					if($nome == '' || strlen($nome) < 3){
						\App\Utilidades::alerta('Você precisa inserir um nome...');
						\App\Utilidades::redirect(INCLUDE_PATH.'perfil');
					}

                    if($senha != ''){
						$senha = \App\Bcrypt::hash($senha);
						$atualizar = $pdo->prepare("UPDATE tb_usuarios SET nome = ?, senha = ? WHERE id = ?");
						$atualizar->execute(array($nome,$senha,$_SESSION['id']));
						$_SESSION['nome'] = $nome;
						
						
					}else{
						
						$atualizar = $pdo->prepare("UPDATE tb_usuarios SET nome = ?WHERE id = ?");
						$atualizar->execute(array($nome,$_SESSION['id']));
						$_SESSION['nome'] = $nome;
						
						
					}

                    if($_FILES['file']['tmp_name'] != ''){
                        $file = $_FILES['file'];
						$fileExt = explode('.',$file['name']);
						$fileExt = $fileExt[count($fileExt) - 1];
                        if($fileExt == 'png' || $fileExt == 'jpg' ||$fileExt == 'jpeg'){
                            //Formato válido.
							//Validar tamanho.
							$size = intval($file['size'] / 1024);
							if($size <= 300){
								$uniqid = uniqid().'.'.$fileExt;
								$atualizaImagem = $pdo->prepare("UPDATE tb_usuarios SET img = ? WHERE id = ?");
								$atualizaImagem->execute(array($uniqid,$_SESSION['id']));
								$_SESSION['img'] = $uniqid;
								move_uploaded_file($file['tmp_name'],'C:\xampp\htdocs\Projeto Reddit/uploads/'.$uniqid);
								\App\Utilidades::alerta('Seu perfil foi atualizado junto com a foto!');
								\App\Utilidades::redirect(INCLUDE_PATH.'perfil');

								
							}else{
								\App\Utilidades::alerta('Erro ao processar seu arquivo.');
								\App\Utilidades::redirect(INCLUDE_PATH.'perfil');
							}
						}else{
							\App\Utilidades::alerta('Erro ao processar seu arquivo.');
							\App\Utilidades::redirect(INCLUDE_PATH.'perfil');
						}

                        }

                          
					     \App\Utilidades::alerta('Seu perfil foi atualizado com sucesso!');
					     \App\Utilidades::redirect(INCLUDE_PATH.'perfil');

                    }

                    \App\Views\MainViews::render('perfil');
                }else{
                    \App\Utilidades::redirect(INCLUDE_PATH);
                }

            }
        }
     
  

?>