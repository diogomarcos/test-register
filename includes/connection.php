<?php
/**
 * Author: Diogo Marcos de Oliveira
 * Date: 12/03/2017
 * Site: http://www.diogomarcos.com
 */

require_once 'configuration.php';

try {
    $connection = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASSWORD);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
    echo $exception->getMessage();
}
