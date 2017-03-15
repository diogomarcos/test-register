<?php
/**
 * Author: Diogo Marcos de Oliveira
 * Date: 14/03/2017
 * Site: http://www.diogomarcos.com
 */

include_once "Connection.php";
include_once "../Controller/ClientDao.php";
include_once "../Controller/PhoneDao.php";

if ($_REQUEST['delete']) {
    $id = $_REQUEST['delete'];

    // Excluindo os telefones cadastrados
    $phone_dao = new \Controller\PhoneDao();
    $delete_phone = $phone_dao->delete($id);

    // Excluindo o cliente
    $client_dao = new \Controller\ClientDao();
    $delete_cliente = $client_dao->delete($id);

    if ($delete_cliente) {
        echo "Cliente excluido com sucesso...";
    }
}
