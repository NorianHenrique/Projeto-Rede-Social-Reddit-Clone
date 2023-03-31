<?php
    namespace App\Mondels;

    class UsuariosMondel{
         
        public static function emailExists($email){
            $pdo = \App\MySql::connect();
            $vereficar = $pdo->prepare("SELECT email FROM tb_usuarios WHERE email = ? ");
            $vereficar->execute(array($email));

             if($vereficar->rowCount() == 1){
                 //O email existe//
                 return true;
             }else{
                return false;
             }
        }

        	public static  function listarComunidade(){
			$pdo = \App\MySql::connect();

			$comunidade =$pdo->prepare("SELECT * FROM tb_usuarios ");
			$comunidade->execute();

			return $comunidade->fetchAll();
		}

        public static function solicitarComunidade($idPara){

			$pdo = \App\MySql::connect();

			$verificaComunidade = $pdo->prepare("SELECT * FROM comunidades WHERE (enviou = ? AND recebeu = ?) OR 
				(enviou = ? AND recebeu = ?)");

			$verificaComunidade->execute(array($_SESSION['id'],$idPara,$idPara,$_SESSION['id']));

			if($verificaComunidade->rowCount() == 1){
				return false;
			}else{
				//Podemos inserir no banco a solicitação
				$insertComunidade = $pdo->prepare("INSERT INTO comunidades VALUES (null,?,?,0)");
				if(
				$insertComunidade->execute(array($_SESSION['id'],$idPara))){
					return true;
				}
			}


			return true;
		}

        public static function listarComunidadesPendentes(){

			$pdo = \App\MySql::connect();

			$listarComunidadesPendentes = $pdo->prepare("SELECT * FROM comunidades WHERE recebeu = ? AND status = 0 ");

			$listarComunidadesPendentes->execute(array($_SESSION['id']));

			return $listarComunidadesPendentes->fetchAll();

		}

        public static function getUsuarioById($id){
			$pdo = \App\MySql::connect();

			$usuario = $pdo->prepare("SELECT * FROM tb_usuarios WHERE id = ? ");

			$usuario->execute(array($id));

			return $usuario->fetch();
		}

        public static function existePedidoComunidades($idPara){
			$pdo = \App\MySql::connect();

			$verificaAmizade = $pdo->prepare("SELECT * FROM comunidades WHERE (enviou = ? AND recebeu = ?) OR 
				(enviou = ? AND recebeu = ?)");

			$verificaAmizade->execute(array($_SESSION['id'],$idPara,$idPara,$_SESSION['id']));

			if($verificaAmizade->rowCount() == 1){
				return false;
			}else{
				return true;
			}
		}


     public static function atualizarPedidoComunidade($enviou,$status){
        $pdo = \App\MySql::connect();

        if($status == 0){
            //Recusei o pedido.
            
            $del = $pdo->prepare("DELETE FROM comunidades WHERE enviou = ? AND recebeu = ? AND status = 0");
            $del->execute(array($enviou,$_SESSION['id']));

        }else if($status == 1){

            $aceitarPedido = $pdo->prepare("UPDATE comunidades SET status = 1 WHERE enviou = ? AND recebeu = ?");


            $aceitarPedido->execute(array($enviou,$_SESSION['id']));

            if($aceitarPedido->rowCount() == 1){
                return true;
            }else{
                return false;
            }


        }

    }

     public static function listarComunidades(){
        $pdo = \App\MySql::connect();

        $comunidades = $pdo->prepare("SELECT * FROM comunidades WHERE (enviou = ? AND status = 1) OR (recebeu = ? AND status = 1)");
        $comunidades->execute(array($_SESSION['id'],$_SESSION['id']));

        $comunidades = $comunidades->fetchAll();
        $comunidadesConfirmados = array();
        foreach ($comunidades as $key => $value) {
            if($value['enviou'] == $_SESSION['id']){
                $comunidadesConfirmados[] = $value['recebeu'];
            }else{
                $comunidadesConfirmados[] = $value['enviou'];
            }
        }

        $listaComunidades = array();

        foreach ($comunidadesConfirmados as $key => $value) {
            $listaComunidades[$key]['nome'] = self::getUsuarioById($value)['nome'];
            $listaComunidades[$key]['img'] = self::getUsuarioById($value)['img'];
        }

        return $listaComunidades;


    }



}

?>

