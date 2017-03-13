<?php
/**
 * Author: Diogo Marcos de Oliveira
 * Date: 12/03/2017
 * Site: http://www.diogomarcos.com
 */

session_start();
require_once 'Connection.php';


if (isset($_POST['btn-login'])) {
    $user = trim($_POST['user']);
    $password = trim($_POST['password']);

    //$password = md5($password);

    try {
        $instance = Connection::getInstance();
        $stmt = $instance->prepare("SELECT * FROM login WHERE user=:user");
        $stmt->execute(array(":user"=>$user));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();

        if ($row['password']==$password) {
            echo "ok";
            $_SESSION['user_session'] = $row['id'];
        } else {
            echo "Usuário ou senha incorretos!";
        }
    } catch (PDOException $exception) {
        echo $exception->getMessage();
    }
}
