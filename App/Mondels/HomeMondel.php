<?php
	
	namespace App\Mondels;

    class HomeMondel{
          
        public static function postFeed($post){
			$pdo = \App\MySql::connect();
			$post = strip_tags($post);
			
			if(preg_match('/\[imagem/',$post)){
				$post = preg_replace('/(.*?)\[imagem=(.*?)\]/', '<p>$1</p><img src="$2" />', $post)	;
			}else{
				$post = '<p>'.$post.'</p>';
			}
           
             
            $postFeed = $pdo->prepare("INSERT INTO `post` VALUES (null,?,?,?)");
            $postFeed->execute(array($_SESSION['id'],$post,date('Y-m-d H:i:s',time())));

            $atualizarPost = $pdo->prepare("UPDATE tb_usuarios SET ultimo_post = ? WHERE id= ?");
            $atualizarPost->execute(array(date('Y-m-d H:i:s',time()),$_SESSION['id']));      
    }

    public static function retrieveComunidadesPosts(){

        $pdo = \App\MySql::connect();

        $comunidades = $pdo->prepare("SELECT * FROM comunidades WHERE (enviou = ? AND status = 1) OR (recebeu = ? AND status = 1)");
        $comunidades->execute(array($_SESSION['id'],$_SESSION['id']));

        $comunidades = $comunidades->fetchAll();
        $comunidadesConfirmadas = array();
        foreach ($comunidades as $key => $value) {
            if($value['enviou'] == $_SESSION['id']){
                $comunidadesConfirmadas[] = $value['recebeu'];
            }else{
                $comunidadesConfirmadas[] = $value['enviou'];
            }
        }

        $listaComunidades = array();

        foreach ($comunidadesConfirmadas as $key => $value) {
            $listaComunidades[$key]['id'] = \App\Mondels\UsuariosMondel::getUsuarioById($value)['id'];
            $listaComunidades[$key]['nome'] = \App\Mondels\UsuariosMondel::getUsuarioById($value)['nome'];
            $listaComunidades[$key]['email'] = \App\Mondels\UsuariosMondel::getUsuarioById($value)['email'];
            $listaComunidades[$key]['img'] = \App\Mondels\UsuariosMondel::getUsuarioById($value)['img'];
            $listaComunidades[$key]['ultimo_post'] = \App\Mondels\UsuariosMondel::getUsuarioById($value)['ultimo_post'];
        }

        usort($listaComunidades,function($a,$b){
            if(strtotime($a['ultimo_post']) >  strtotime($b['ultimo_post'])){
                return -1;
            }else{
                return +1;
            }
        });
        $posts = [];

        foreach ($listaComunidades as $key => $value) {

            $ultimoPost = $pdo->prepare("SELECT * FROM post WHERE usuario_id = ? ORDER BY date DESC");
            $ultimoPost->execute(array($value['id']));
            if($ultimoPost->rowCount() >= 1){
                $ultimoPost = $ultimoPost->fetch();
                $posts[$key]['usuario'] = $value['nome'];
                $posts[$key]['img'] = $value['img'];
                $posts[$key]['data'] = $ultimoPost['date'];
                $posts[$key]['conteudo'] = $ultimoPost['post'];

                
            }
        }
        
        $me = $pdo->prepare("SELECT * FROM tb_usuarios WHERE id = $_SESSION[id]");

        $me->execute();

        $me = $me->fetch();

        if(isset($posts[0])){
            if(strtotime($me['ultimo_post']) > strtotime($posts[0]['data'])  ){
                $ultimoPost = $pdo->prepare("SELECT * FROM post WHERE usuario_id = $_SESSION[id] ORDER BY date DESC");
                $ultimoPost->execute();
                $ultimoPost = $ultimoPost->fetchAll()[0];
                array_unshift($posts, array('data'=>$ultimoPost['date'],'conteudo'=>$ultimoPost['post'],'me'=>true  ));
            }
        }


        return $posts;


    }



   }

?>