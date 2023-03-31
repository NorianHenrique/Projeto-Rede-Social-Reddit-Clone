<html>
    <head>
        <title>Reddit Login</title>
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

    <div class="sidebar_login"></div>

<div class="form-container-login">

    <div class="logo-chamada-login">
    
        <img src="<?php echo INCLUDE_PATH_STATIC ?>imagens/logo.png" />
        <p>Conecte-se com seus amigos e expanda seus aprendizados com a rede social Reddit.</p>
        

    </div><!--logo-chamada-login-->

    <div class="form-login">
            <form method="post">
                <input type="text" name="email" placeholder="Login...">
                <input type="password" name="senha" placeholder="Senha...">
                <input type="submit" name="acao" value="Logar!">
                <input type="hidden" name="login">
            </form>
            <p><a href="<?php echo INCLUDE_PATH ?>registrar">Criar Conta</a></p>
    </div><!--form-login-->

</div>


    </body>
</html>