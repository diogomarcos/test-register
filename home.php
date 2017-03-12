<?php
/**
 * Author: Diogo Marcos de Oliveira
 * Date: 12/03/2017
 * Site: http://www.diogomarcos.com
 */

session_start();

if (!isset($_SESSION['user_session'])) {
    header("Location: index.php");
}

include_once "includes/connection.php";
$stmt = $connection->prepare("SELECT * FROM login WHERE id=:id");
$stmt->execute(array(":id"=>$_SESSION['user_session']));
$row=$stmt->fetch(PDO::FETCH_ASSOC);

include_once "template/header.php";
?>

<h1>Conteúdo</h1>

<?php include_once "template/footer.php"; ?>