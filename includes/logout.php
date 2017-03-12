<?php
/**
 * Author: Diogo Marcos de Oliveira
 * Date: 12/03/2017
 * Site: http://www.diogomarcos.com
 */

session_start();
unset($_SESSION['user_session']);

if (session_destroy()) {
    header("Location: ../index.php");
}
