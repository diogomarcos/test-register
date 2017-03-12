<?php
/**
 * Author: Diogo Marcos de Oliveira
 * Date: 11/03/2017
 * Site: http://www.diogomarcos.com
 */

session_start();

if(isset($_SESSION['user_session'])!=""){
    header("Location: home.php");
}
?>
<!DOCTYPE html>
<html lang="pt-BR" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="CONTENT-TYPE" content="text/html; charset=utf-8" />
    <title>Acesso :: Test Register</title>
    <link href="assets/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">

    <script type="text/javascript" src="assets/jquery/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="assets/jquery/jquery.validate.min.js"></script>

    <link href="assets/styles/style.css" rel="stylesheet" type="text/css" media="screen">
    <script type="text/javascript" src="assets/scripts/script.js"></script>
</head>

<body>
    <div class="container">
        <form id="form-login" class="form-login" method="post">
            <h2 class="form-login-heading">Entrar no Test Register</h2>
            <hr/>
            <div id="error"></div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Usuário" name="user" id="user" />
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Senha" name="password" id="password" />
            </div>
            <hr/>
            <div class="form-group">
                <button type="submit" class="btn btn-default" name="btn-login" id="btn-login">
                    <span class="glyphicon glyphicon-log-in"></span> &nbsp; Entrar
                </button>
            </div>
        </form>
    </div>
    <script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>